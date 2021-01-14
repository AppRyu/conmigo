<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Community extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'created_user', 'start', 'end', 'detail'
    ];

    public function users() 
    {
        return $this->belongsTo('App\User', 'created_user', 'id');
    }

    public function recruits()
    {
        return $this->hasMany('App\Recruit', 'community_id', 'id');
    }

    public function members()
    {
        return $this->hasMany('App\Member', 'community_id', 'id');
    }

    public function communityMessages()
    {
        return $this->hasMany('App\CommunityMessages', 'community_id', 'id');
    }

    /**
     * 
     * @return boolean 
     */
    public function isAppliedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->recruits->where('applied_user', $user->id)->count()
            : false;
    }

    /**
     * 合計募集数を取得
     * 
     * @return integer
     */
    public function getTotalRecruitment():int
    {
        return (int)$this->recruits->where('community_id', $this->id)->count();
    }

    /**
     * 現在日時より過去が判定
     * 
     * @param datetime
     * @return boolean
     */
    public function isPast($dateAndTime):bool
    {
        $dt = new Carbon($dateAndTime);
        return $dt->isPast();
    }

    /**
     * 日付のフォーマットを整える
     * 
     * DBから取得した日時から、時刻を削除して日付のみ取得
     * ex 2020-12-15 12:30:30 -> 2020年12月15日
     * 
     * @param string $value
     * @return string $formattedDate
     */
    private static function formatDate(string $value): string
    {
        $date = substr($value, 0, 10);
        $date = preg_split('|[/.\-]|', $date);
        $formattedDate = "{$date[0]}年{$date[1]}月{$date[2]}日";
        return $formattedDate;
    }

    /**
     * 時刻のフォーマットを整える
     * 
     * DBから取得した日時から、日時を削除して時刻のみ取得
     * ex 2020-12-15 12:30:30 -> [ 午前 or 午後 ]12時30分
     * 
     * @param string $value
     * @return string $formattedTime
     */
    private static function formatTime(string $value): string
    {
        $time = substr($value, -8, 8);
        $time = preg_split('|[/.\:]|', $time);
        $hours = (int)$time[0];
        $minutes = (int)$time[1]; 
        if($hours <= 12) {
            $periodOfTime = '午前';
        } else {
            $periodOfTime = '午後';
        }
        $formattedTime = "{$periodOfTime}{$hours}時{$minutes}分";
        return $formattedTime;
    }

    /**
     * 時刻と日付を取得
     * 
     * @param string $value
     * @return string $dateAndTime
     */
    public function getDateAndTime(string $value): string
    {
        $date = self::formatDate($value);
        $time = self::formatTime($value);
        $dateAndTime = "{$date} {$time}";
        return $dateAndTime;
    }

    /**
     * 日付を取得
     * 
     * @param string $value
     * @return string $date
     */
    public function getDate(string $value): string 
    {
        return $this->formatDate($value);
    }

    /**
     * 時間を取得
     * 
     * @param string $value
     * @return string $time
     */
    public function getTime(string $value): string
    {
        return $this->formatTime($value);
    }
}