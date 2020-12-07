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
            'start' => 'required',
            'end'   => 'required',
            'detail'     => 'required|string|max:500'
        ];
    }

    public function attributes()
    {
        return [
            'start'  => '開始日時',
            'end'    => '終了日時' 
        ];
    }
}
