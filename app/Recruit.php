<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recruit extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'community_id', 'applied_user'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo('App\User', 'applied_user', 'id');
    }

    public function communities(): BelongsTo
    {
        return $this->belongsTo('App\Community', 'community_id', 'id');
    }
}
