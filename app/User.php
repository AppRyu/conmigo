<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function messages(): HasMany
    {
        return $this->hasMany('App\Message');
    }

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany('App\Room')->withTimestamps();
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($user) {
            $user->communities()->delete();
            $user->recruits()->delete();
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

    public function getLastLoginAttribute(): string
    {
        // 最終ログイン時刻を取得
        $lastLoginTime = new Carbon($this->attributes['last_login_at']);
        // 最終ログイン時刻をUNIXタイムスタンプへ変換
        $lastLoginTimeUnix = $lastLoginTime->format('U');
        // 現在時刻を取得
        $currentTime = new Carbon();
        // 現在時刻をUNIXタイムスタンプへ変換
        $currentTimeUnix = $currentTime->format('U');
        // 差分を取得
        $timeLag = $currentTimeUnix - $lastLoginTimeUnix;
        if($timeLag > 2592000) {
            $month = floor($timeLag/2592000);
            return $month.'ヶ月前';
        } elseif($timeLag > 86400) {
            $day = floor($timeLag/86400);
            return $day.'日前';
        } elseif($timeLag > 3600) {
            $hour = floor($timeLag/3600);
            return $hour.'時間前';
        } elseif($timeLag > 60) {
            $min = floor($timeLag/60);
            return $min.'分前';
        } else {
            return '0分前';
        }
    }
}
