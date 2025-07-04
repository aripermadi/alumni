<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
    protected $fillable = [
        'user_id', 'title', 'description', 'company', 'location', 'deadline', 'link', 'status', 'logo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 