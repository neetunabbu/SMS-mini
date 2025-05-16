<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes; // Added SoftDeletes

    // Define fillable fields
    protected $fillable = [
        'student_id', 'class_id', 'date', 'status',
    ];

    // Date casting for the 'date' field
    protected $dates = [
        'date',
    ];

    // Relationship with the Student model
    public function student()
{
    return $this->belongsTo(Student::class, 'student_id');
}

public function schoolClass()
{
    return $this->belongsTo(SchoolClass::class, 'class_id');
}

}
