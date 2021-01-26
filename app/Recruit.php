<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recruit extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'community_id', 'applied_user'
    ];

    public function users()
    {
        return $this->belongsTo('App\User', 'applied_user', 'id');
    }

    public function communities()
    {
        return $this->belongsTo('App\Community', 'community_id', 'id');
    }
}
