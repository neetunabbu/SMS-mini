<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone_number', 'user_id',
    ];

    public function students()
{
    return $this->hasMany(Student::class); // A teacher has many students
}

public function user()
{
    return $this->belongsTo(User::class); // A teacher belongs to a user
}

public function schoolClasses()
{
    return $this->hasMany(SchoolClass::class, 'teacher_id');
}

public function teacher()
{
    return $this->belongsTo(Teacher::class, 'teacher_id');
}



}