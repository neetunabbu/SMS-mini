<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Student; // Import the Student model to get student data
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(); // Create Faker instance to generate random data
        
        // Get all students to assign attendance
        $students = Student::all();

        // Loop through each student to create attendance records
        foreach ($students as $student) {
            // You can specify how many attendance records to create per student
            for ($i = 0; $i < 10; $i++) { // Example: 10 attendance records for each student
                Attendance::create([
                    'student_id' => $student->id,
                    'date' => $faker->date(), // Random date
                    'status' => $faker->randomElement(['Present', 'Absent']), // Random status
                ]);
            }
        }
    }
}
