<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'description',
    ];

    public function schoolyear()
    {
        return $this->belongsTo(SchoolYear::class, 'schoolyear_id');
    }
}
