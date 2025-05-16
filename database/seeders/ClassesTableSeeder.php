<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch two existing teachers
        $teacher1 = User::first();
        $teacher2 = User::skip(1)->first();

        // Check if teachers exist (optional safety check)
        if (!$teacher1 || !$teacher2) {
            echo "Please seed some teachers first!\n";
            return;
        }

        // Now insert your classes
        DB::table('school_classes')->insert([
            [
                'name' => 'Class A',
                'class_name' => 'A-1',
                'subject' => 'Math',
                'teacher_id' => $teacher1->id,
                'student_count' => 30,
                'section' => 'Section 1',
                'description' => 'Basic Math class',
                'class_code' => 'A1-MATH',
                'is_active' => true,
            ],
            [
                'name' => 'Class B',
                'class_name' => 'B-1',
                'subject' => 'Science',
                'teacher_id' => $teacher2->id,
                'student_count' => 28,
                'section' => 'Section 2',
                'description' => 'Basic Science class',
                'class_code' => 'B1-SCI',
                'is_active' => true,
            ],
        ]);
    }
}
