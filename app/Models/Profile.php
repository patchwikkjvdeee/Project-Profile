<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'tagline', 'bio', 'skills', 'fun_fact', 'email', 'github', 'city',
    ];

    protected $casts = [
        'skills' => 'array',
    ];
}
