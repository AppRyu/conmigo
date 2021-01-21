<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id', 'community_id'
    ];

    public function users() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function communities() 
    {
        return $this->belongsTo('App\Community', 'community_id', 'id');
    }
}
