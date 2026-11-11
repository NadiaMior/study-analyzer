<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudySession extends Model
{
    use HasFactory;

    // TAMBAH BARIS INI:
    public $timestamps = false; 

    protected $fillable = [
        'user_id', 
        'subject', 
        'planned_seconds', 
        'elapsed_seconds', 
        'status', 
        'started_at', 
        'running_since', 
        'ended_at'
    ];
}