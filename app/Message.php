<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = [
        'body', 'room_id', 'user_id'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function rooms(): BelongsTo
    {
        return $this->belongsTo('App\Room');
    }
}
