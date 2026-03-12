<?php
namespace Database\Seeders;

use App\Models\SchoolDay;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SchoolDaySeeder extends Seeder {
    public function run(): void {
        $holidays = [
            '2024-01-01'=>"New Year's Day",   '2024-04-09'=>'Araw ng Kagitingan',
            '2024-04-10'=>'Maundy Thursday',  '2024-04-11'=>'Good Friday',
            '2024-05-01'=>'Labor Day',        '2024-06-12'=>'Independence Day',
            '2024-08-26'=>'National Heroes Day','2024-11-01'=>"All Saints' Day",
            '2024-11-30'=>'Bonifacio Day',    '2024-12-25'=>'Christmas Day',
            '2024-12-30'=>'Rizal Day',
        ];
        $events = [
            '2024-03-15'=>'Foundation Day',   '2024-05-15'=>'Intramurals Day 1',
            '2024-05-16'=>'Intramurals Day 2','2024-07-20'=>'Science Fair',
            '2024-09-05'=>'Career Fair',
        ];

        $current = Carbon::create(2024, 1, 1);
        $end     = Carbon::create(2024, 12, 31);

        while ($current->lte($end)) {
            $d = $current->format('Y-m-d');
            $dow = $current->dayOfWeek;

            if (isset($holidays[$d])) {
                SchoolDay::create(['date'=>$d,'type'=>'holiday','description'=>$holidays[$d],'attendance_count'=>0]);
            } elseif (isset($events[$d])) {
                SchoolDay::create(['date'=>$d,'type'=>'event','description'=>$events[$d],'attendance_count'=>rand(400,500)]);
            } elseif ($dow !== Carbon::SATURDAY && $dow !== Carbon::SUNDAY) {
                SchoolDay::create(['date'=>$d,'type'=>'class','description'=>'Regular Class Day','attendance_count'=>rand(350,490)]);
            }
            $current->addDay();
        }
    }
}