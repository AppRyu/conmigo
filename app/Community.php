<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $fillable = ['name', 'created_user', 'start_time', 'end_time', 'detail'];

    private static $replace = [
            '年' => '-',
            '月' => '-',
            '日' => '',
            '時' => ':',
            '分' => '',
    ];

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = str_replace(array_keys(self::$replace), array_values(self::$replace), $value);
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = str_replace(array_keys(self::$replace), array_values(self::$replace), $value);
    }
}
