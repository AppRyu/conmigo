<?php

namespace App\Http\Requests;

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
            'name'      => 'required|string|max:50',
            'user_name' => 'required|string|max:15|alpha_dash|unique:users,user_name,' . $this->user()->id,
            'comment'   => 'nullable|string|max:500',
            'mysite'    => 'nullable|max:255',
            'twitter'   => 'nullable|max:255',
            'instagram' => 'nullable|max:255',
            'facebook'  => 'nullable|max:255',
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
