<?php
namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder {
    public function run(): void {
        $courses  = ['BSIT','BSCS','BSECE','BSBA','BSED','BSME','BSCE','BSN'];
        $genders  = ['Male','Female'];
        $cities   = ['Manila','Quezon City','Cebu City','Davao City','Makati',
                     'Pasig','Taguig','Caloocan','Marikina','Paranaque'];

        for ($i = 1; $i <= 500; $i++) {
            $first  = fake()->firstName();
            $last   = fake()->lastName();
            $course = $courses[array_rand($courses)];

            Student::create([
                'name'           => "$first $last",
                'email'          => strtolower("{$first}.{$last}{$i}@school.edu.ph"),
                'gender'         => $genders[array_rand($genders)],
                'course'         => $course,
                'year_level'     => rand(1, 4),
                'address'        => $cities[array_rand($cities)],
                'birthdate'      => fake()->date('Y-m-d', '-20 years'),
                'contact_number' => '09' . rand(100000000, 999999999),
            ]);
        }
    }
}