<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'learners_reference_number', 'enrollment_status',
        'firstname', 'middlename', 'lastname', 'extname',
        'birthdate', 'sex', 'street', 'barangay',
        'municipal', 'province', 'zip_code',
        'mother_name', 'father_name', 'guardian_name',
        'emergency_contact_number', 'last_elementary_school', 'last_grade_level_completed',
        'last_school_year_completed', 'last_school_name', 'last_school_address',
        'last_school_id',
    ];
    protected $appends = ["age"];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
