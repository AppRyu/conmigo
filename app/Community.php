<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $fillable = ['name', 'created_user', 'start_time', 'end_time', 'detail'];

    private const DATE_REPLACE = [
            '年' => '-',
            '月' => '-',
            '日' => '',
            '時' => ':',
            '分' => '', 
    ];

    private static function formattedTime($value)
    {
        // 日付のみを取得
        // ex 2020-12-15 12:30:30 -> 2020-12-15
        $date = substr($value, 0, 10);
        $date = preg_split('|[/.\-]|', $date);
        // 時間のみを取得
        // ex 2020-12-15 12:30:30 -> 12:30:30
        $time = substr($value, -8, 8);
        $time = preg_split('|[/.\:]|', $time);
        $hours = (int)$time[0];
        $minutes = (int)$time[1]; 
        if($hours <= 12) {
            $border = '午前';
        } else {
            $border = '午後';
        }
        $result = "{$date[0]}年{$date[1]}月{$date[2]}日{$border}{$hours}時{$minutes}分";
        return $result;
    }

    public function getStartTimeAttribute($value)
    {
        $result = self::formattedTime($value);
        return $this->attributes['start_time'] = $result;
    }

    public function getEndTimeAttribute($value) 
    {
        $result = self::formattedTime($value);
        return $this->attributes['end_time'] = $result;
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = str_replace(array_keys(self::DATE_REPLACE), array_values(self::DATE_REPLACE), $value);
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = str_replace(array_keys(self::DATE_REPLACE), array_values(self::DATE_REPLACE), $value);
    }
}
