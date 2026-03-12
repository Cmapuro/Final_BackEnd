<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\SchoolDay;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {

    // Monthly enrollment → Bar Chart
    public function enrollment() {
        $months = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',
                   7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec'];
        $data = Student::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')->get()
            ->map(fn($r) => ['month'=>$months[$r->month],'count'=>$r->count]);
        return response()->json($data);
    }

    // Students per course → Pie Chart
    public function distribution() {
        $data = Student::selectRaw('course, COUNT(*) as count')
            ->groupBy('course')->orderByDesc('count')->get();
        return response()->json($data);
    }

    // Attendance trend → Line Chart
    public function attendance() {
        $data = SchoolDay::where('type','class')->orderBy('date')->take(30)
            ->get(['date','attendance_count'])
            ->map(fn($r) => ['date'=>$r->date->format('M d'),'attendance_count'=>$r->attendance_count]);
        return response()->json($data);
    }

    // Summary stats
    public function stats() {
        return response()->json([
            'total_students'    => Student::count(),
            'total_courses'     => Course::count(),
            'total_school_days' => SchoolDay::count(),
            'male_students'     => Student::where('gender','Male')->count(),
            'female_students'   => Student::where('gender','Female')->count(),
            'avg_attendance'    => round(SchoolDay::where('type','class')->avg('attendance_count')),
        ]);
    }
}