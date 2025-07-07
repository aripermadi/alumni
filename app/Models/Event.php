<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'location',
        'user_id',
        'image',
    ];

    public function images()
    {
        return $this->hasMany(EventImage::class)->orderBy('order');
    }

    public function getMainImageAttribute()
    {
        return $this->image ?? $this->images->first()?->image_path;
    }
}
