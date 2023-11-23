<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_year_id', 'student_id', 'code', 'description', 'amount', 'amount_paid', 'billing_status',
        'payment_date'
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function schoolyear(){
        return $this->belongsTo(SchoolYear::class, 'school_year_id');
    }
}
