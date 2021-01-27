<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommunityMessages extends Model
{
    protected $table = 'community_messages';

    protected $fillable = [
        'user_id', 'community_id', 'message'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function communities(): BelongsTo
    {
        return $this->belongsTo('App\Community', 'community_id', 'id');
    }

    public function userWithTrashed(int $value): Object
    {
        return User::withTrashed()->where('id', $value)->first();
    }
}
