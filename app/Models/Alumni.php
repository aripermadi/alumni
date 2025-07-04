<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni';
    protected $fillable = [
        'user_id', 'angkatan', 'jurusan', 'pekerjaan', 'alamat', 'no_hp', 'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function locations()
    {
        return $this->hasMany(AlumniLocation::class);
    }
} 