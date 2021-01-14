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

    private const DATE_REPLACE = [
        '年' => '-',
        '月' => '-',
        '日' => '',
        '時' => ':',
        '分' => '', 
    ];

    protected function prepareForValidation()
    {
        if($this->start && $this->end) {
            $this->merge([
                'start' => str_replace(array_keys(self::DATE_REPLACE), array_values(self::DATE_REPLACE), $this->start),
                'end' => str_replace(array_keys(self::DATE_REPLACE), array_values(self::DATE_REPLACE), $this->end),
            ]);
        }
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
            'start'      => 'required|after:now',
            'end'        => 'required|after:start',
            'detail'     => 'required|string|max:500'
        ];
    }

    public function messages()
    {
        return [
            'name.max'      => ':max文字以内で入力してください',
            'start.after'  => '現在より前の日時を指定してください',
            'end.after'     => ':attributeより後の日時をしていしてください',
            'detail.max'    => ':max文字以内で入力してください',
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
