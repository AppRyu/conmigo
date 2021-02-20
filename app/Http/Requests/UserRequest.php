<?php

namespace App\Http\Requests;

use App\Rules\alpha_num_check;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'      => 'string|max:15',
            'user_name' => 'string|max:15|unique:users,user_name,' . $this->user()->id,
            'user_name' => [new alpha_num_check],
            'comment'   => 'string|max:500',
            'mysite'    => 'max:255',
            'twitter'   => 'max:255',
            'instagram' => 'max:255',
            'facebook'  => 'max:255',
            'email'     => 'string|email|max:255|unique:users,email,' . $this->user()->email, 
        ];
    }

    public function attributes()
    {
        return [
            'user_name' => 'ユーザーネーム',
            'comment'   => 'コメント',
            'mysite'    => 'WEBサイト'
        ];
    }

    public function messages()
    {
        return [
            'user_name.max' => '15文字以内で入力してください',
        ];
    }
}
