<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchProfileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'admission_time' => ['required'],
            'admission_type' => ['required'],
            'phone_nid' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'admission_time.required' => 'Vui lòng chọn đợt xét tuyển',
            'admission_type.required' => 'Vui lòng chọn hình thức xét tuyển',
            'phone_nid.required' => 'Vui lòng nhập số điện thoại/ CMND/ CCCD',
        ];
    }
}
