<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniLocation extends Model
{
    protected $table = 'alumni_locations';
    protected $fillable = [
        'alumni_id', 'latitude', 'longitude',
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
} 