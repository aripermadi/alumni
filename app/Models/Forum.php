<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = [
        'user_id', 'judul', 'isi', 'category_id', 'sticky', 'image', 'video'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function replies() { return $this->hasMany(ForumReply::class); }
    public function category() { return $this->belongsTo(ForumCategory::class, 'category_id'); }
} 