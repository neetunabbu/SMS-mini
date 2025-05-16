<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::create([
            'name' => 'Amina Patel',
            'email' => 'amina@example.com',
            'roll_number' => 'R001',
            'class_id' => 1, // assuming Class 6 has ID 1
            'teacher_id' => 1, // assuming Ayesha is ID 1
            'user_id' => 1, // logged-in user/admin
        ]);

        Student::create([
            'name' => 'Zaid Ali',
            'email' => 'zaid@example.com',
            'roll_number' => 'R002',
            'class_id' => 2,
            'teacher_id' => 2,
            'user_id' => 1,
        ]);
    }
}
