<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRoom extends Model
{
    protected $table = 'user_room';

    protected $fillable = ['user_id', 'room_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo('App\Room');
    }
}
