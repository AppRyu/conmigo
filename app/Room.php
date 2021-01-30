<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Auth;

class Room extends Model
{
    public function users(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'user_room')->withTimestamps();
    }

    public function messages(): HasMany
    {
        return $this->hasMany('App\Message');
    }

    public function getUserWithoutAuthUserAttribute(): Object
    {
        return $this->users()->where('user_id', '!=', Auth::user()->id)->first();
    }

    public function getMostRecentlyMessageAttribute(): ?Object
    {
        return $this->messages()->orderBy('created_at', 'desc')->first();
    }
}
