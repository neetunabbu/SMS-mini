<?php

namespace Database\Seeders;

use App\Models\Leave;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakeLeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Leave::create([
            'teacher_id' => 1, // Replace with an actual teacher ID
            'student_id' => 1, // Replace with an actual student ID
            'leave_type' => 'Sick Leave',
            'start_date' => '2025-05-01',
            'end_date' => '2025-05-03',
            'status' => 'pending', // Initially set to 'pending'
        ]);
    }
}
