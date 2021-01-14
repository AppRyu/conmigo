<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommunityMessages extends Model
{
    protected $table = 'community_messages';

    protected $fillable = [
        'user_id', 'community_id', 'message'
    ];

    public function users() 
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function communities() 
    {
        return $this->belongsTo('App\Community', 'community_id', 'id');
    }

    public function userWithTrashed($value)
    {
        return \App\User::withTrashed()->where('id', $value)->first();
    }
}
