<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Columns that are allowed to modify
    protected $fillable = [
        'name', 
        'description', 
        'completed'
    ];

    
}
