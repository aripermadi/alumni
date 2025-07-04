<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    protected $fillable = ['user1_id', 'user2_id', 'last_message_at'];

    public function user1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user1_id');
    }
    public function user2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user2_id');
    }
    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }
} 