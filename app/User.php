<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_name', 'comment', 'profile_image', 'mysite', 'twitter', 'instagram', 'facebook', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function communities(): HasMany
    {
        return $this->hasMany('App\Community', 'created_user', 'id');
    }

    public function recruits(): HasMany
    {
        return $this->hasMany('App\Recruit', 'applied_user', 'id');
    }

    public function members(): HasMany
    {
        return $this->hasMany('App\Member', 'user_id', 'id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany('App\Like', 'user_id', 'id');
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'follows', 'followee_id', 'follower_id')->withTimestamps();
    }

    public function followings(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'follows', 'follower_id', 'followee_id')->withTimestamps();
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($user) {
            $user->communities()->delete();
        });
    }

    public function isFollowedBy(?User $user): bool
    {
        return $user ? (bool)$this->followers->where('id', $user->id)->count() : false;
    }

    public function getCountFollowersAttribute(): int
    {
        return $this->followers->count();
    }

    public function getCountFollowingsAttribute(): int
    {
        return $this->followings->count();
    }
}
