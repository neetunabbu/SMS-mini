<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    // Fillable attributes for mass assignment
    protected $fillable = [
        'student_id', 'class_id', 'subject', 'marks_obtained', 'max_marks', 'exam_type',
    ];

    /**
     * Get the student that owns the mark.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the class associated with the mark.
     */
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id', 'id');
    }
}
