<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teachers')->insert([
            [
                'name' => 'Teacher X',
                'email' => 'teacherx@example.com',
                'phone_number' => '9876543210',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teacher Y',
                'email' => 'teachery@example.com',
                'phone_number' => '8765432109',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
