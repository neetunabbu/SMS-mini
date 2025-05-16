<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'user_id', 'class_id', 'roll_number', 
        'teacher_id',
    ];

    public function teacher()
{
    return $this->belongsTo(Teacher::class, 'teacher_id'); // A student belongs to one teacher
}

public function schoolClass()
{
    return $this->belongsTo(SchoolClass::class, 'class_id'); // A student belongs to one class
}

public function attendance()
{
    return $this->hasMany(Attendance::class); // A student can have many attendance records
}

public function marks()
{
    return $this->hasMany(Mark::class); // A student can have many marks
}

public function leaves()
{
    return $this->hasMany(Leave::class);
}


}