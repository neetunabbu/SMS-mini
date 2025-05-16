<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'class_name',
        'subject',
        'teacher_id',
        'student_count',
        'section',
        'description',
        'class_code',
        'is_active',
    ];

    // Automatically set 'name' to 'class_name' when creating a new class
    protected static function booted()
    {
        static::creating(function ($schoolClass) {
            // Set 'name' to 'class_name' value if it's not already set
            if (is_null($schoolClass->name)) {
                $schoolClass->name = $schoolClass->class_name;
            }
        });
    }

    // A school class has many students
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    // A school class belongs to one teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    // A school class has many marks records
    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    // A school class has many attendance records
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
