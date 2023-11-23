<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'requirement_id', 'school_year_id', 'requirement_status',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function requirement(){
        return $this->belongsTo(Requirement::class);
    }

    public function schoolyear(){
        return $this->belongsTo(SchoolYear::class, 'school_year_id');
    }
}
