<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    public function users(): BelongsToMany
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function messages(): HasMany
    {
        return $this->hasMany('App\Message');
    }
}
