<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommunityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'       => 'required|string|max:50',
            'start_time' => 'required',
            'end_time'   => 'required',
            'detail'     => 'required|string|max:500'
        ];
    }

    public function attributes()
    {
        return [
            'start_time'  => '開始日時',
            'end_time'    => '終了日時' 
        ];
    }
}
