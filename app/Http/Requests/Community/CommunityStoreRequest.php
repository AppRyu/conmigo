<?php

namespace App\Http\Requests\Community;

use Illuminate\Foundation\Http\FormRequest;

class CommunityStoreRequest extends FormRequest
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
            'start'      => 'required|before:end',
            'end'        => 'required|after:start',
            'detail'     => 'required|string|max:500'
        ];
    }

    public function messages()
    {
        return [
            'name.max'      => '50文字以内で入力してください',
            'start.before'  => '終了日時より前の日時を指定してください',
            'end.after'     => '開始日時より後の日時をしていしてください',
            'detail.max'    => '500文字以内で入力してください',
        ];
    }

    public function attributes()
    {
        return [
            'name'   => 'コミュニティ名',
            'start'  => '開始日時',
            'end'    => '終了日時',
            'detail' => 'コミュニティ詳細'
        ];
    }
}
