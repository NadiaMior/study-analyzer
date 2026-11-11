<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyPlan extends Model
{
    use HasFactory;
    public $timestamps = false; // Sebab kita guna 'created_at' manual

    protected $fillable = [
        'user_id', 'title', 'notes', 'plan_date', 'plan_time', 'created_at'
    ];
}