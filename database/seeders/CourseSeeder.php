<?php
namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder {
    public function run(): void {
        $courses = [
            ['code'=>'IT101','name'=>'Introduction to Computing',       'department'=>'IT',        'units'=>3],
            ['code'=>'IT102','name'=>'Programming 1 (C++)',             'department'=>'IT',        'units'=>3],
            ['code'=>'IT103','name'=>'Programming 2 (Java)',            'department'=>'IT',        'units'=>3],
            ['code'=>'IT104','name'=>'Web Development',                 'department'=>'IT',        'units'=>3],
            ['code'=>'IT105','name'=>'Database Management',             'department'=>'IT',        'units'=>3],
            ['code'=>'IT106','name'=>'Systems Analysis and Design',     'department'=>'IT',        'units'=>3],
            ['code'=>'IT107','name'=>'Mobile App Development',          'department'=>'IT',        'units'=>3],
            ['code'=>'IT108','name'=>'Network Administration',          'department'=>'IT',        'units'=>3],
            ['code'=>'CS101','name'=>'Data Structures and Algorithms',  'department'=>'CS',        'units'=>3],
            ['code'=>'CS102','name'=>'Discrete Mathematics',            'department'=>'CS',        'units'=>3],
            ['code'=>'CS103','name'=>'Operating Systems',               'department'=>'CS',        'units'=>3],
            ['code'=>'CS104','name'=>'Artificial Intelligence',         'department'=>'CS',        'units'=>3],
            ['code'=>'CS105','name'=>'Machine Learning',                'department'=>'CS',        'units'=>3],
            ['code'=>'ECE101','name'=>'Circuit Theory',                 'department'=>'ECE',       'units'=>3],
            ['code'=>'ECE102','name'=>'Electronics Engineering',        'department'=>'ECE',       'units'=>3],
            ['code'=>'ECE103','name'=>'Digital Signal Processing',      'department'=>'ECE',       'units'=>3],
            ['code'=>'BA101','name'=>'Principles of Management',        'department'=>'Business',  'units'=>3],
            ['code'=>'BA102','name'=>'Financial Accounting',            'department'=>'Business',  'units'=>3],
            ['code'=>'BA103','name'=>'Marketing Management',            'department'=>'Business',  'units'=>3],
            ['code'=>'ED101','name'=>'Principles of Teaching',          'department'=>'Education', 'units'=>3],
            ['code'=>'ED102','name'=>'Curriculum Development',          'department'=>'Education', 'units'=>3],
            ['code'=>'ED103','name'=>'Educational Technology',          'department'=>'Education', 'units'=>3],
        ];
        foreach ($courses as $c) {
            $c['enrolled_count'] = rand(20, 60);
            Course::create($c);
        }
    }
}   