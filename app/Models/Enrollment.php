<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_year_id', 'student_id', 'section_id', 'enroll_date', 'enrollment_status',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function schoolyear(){
        return $this->belongsTo(SchoolYear::class, 'school_year_id');
    }

    public function section(){
        return $this->belongsTo(Section::class, 'section_id');
    }
}
