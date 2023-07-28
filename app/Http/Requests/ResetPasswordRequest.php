<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Vui lòng nhập :attribute vào mục này',
            'password.confirmed' => 'Mật khẩu không trùng khớp'
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'mật khẩu',
            'password_confirmation' => 'mật khẩu xác thực'
        ];
    }
}
