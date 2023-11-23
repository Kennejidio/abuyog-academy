<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'grade_level',
    ];

    public function grade_level(){
        return $this->belongsTo(GradeLevel::class);
    }
}
