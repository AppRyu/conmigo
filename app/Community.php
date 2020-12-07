<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $fillable = ['name', 'created_user', 'start', 'end', 'detail'];

    private const DATE_REPLACE = [
            '年' => '-',
            '月' => '-',
            '日' => '',
            '時' => ':',
            '分' => '', 
    ];

    /**
     * 日付のフォーマットを整える
     * 
     * DBから取得した日時から、時刻を削除して日付のみ取得
     * ex 2020-12-15 12:30:30 -> 2020-12-15
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
     * ex 2020-12-15 12:30:30 -> 12:30:30
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
    public function getDate(string $value): string  // start or end in $value
    {
        $date = self::formatDate($value);
        return $date;
    }

    /**
     * 時間を取得
     * 
     * @param string $value
     * @return string $time
     */
    public function getTime(string $value): string // start or end in $value
    {
        $time = self::formatTime($value);
        return $time;
    }

    public function setStartAttribute($value)
    {
        $this->attributes['start'] = str_replace(array_keys(self::DATE_REPLACE), array_values(self::DATE_REPLACE), $value);
    }

    public function setEndAttribute($value)
    {
        $this->attributes['end'] = str_replace(array_keys(self::DATE_REPLACE), array_values(self::DATE_REPLACE), $value);
    }
}
