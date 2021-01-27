<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    protected $fillable = [
        'user_id', 'community_id'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function communities(): BelongsTo
    {
        return $this->belongsTo('App\Community', 'community_id', 'id');
    }
}
