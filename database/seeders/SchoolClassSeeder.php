<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolClass;

class SchoolClassSeeder extends Seeder
{
    public function run()
    {
        SchoolClass::create(['name' => 'Class 6']);
        SchoolClass::create(['name' => 'Class 7']);
        SchoolClass::create(['name' => 'Class 8']);
        SchoolClass::create(['name' => 'Class 9']);
        SchoolClass::create(['name' => 'Class 10']);
    }
}
