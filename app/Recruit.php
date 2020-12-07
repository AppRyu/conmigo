<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recruit extends Model
{
    public function communities()
    {
        return $this->belongsTo('App\Community', 'community_id', 'id');
    }
}
