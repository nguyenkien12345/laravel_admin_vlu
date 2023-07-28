<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
            'phone' => ['required', 'regex:/^(09|03|07|08|05)+([0-9]{8}$)/', 'exists:users,phone'],
            'password' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Vui lòng nhập :attribute vào mục này',
            'phone.regex' => 'Định dạng số điện thoại không hợp lệ',
            'exists' => 'Số điện thoại chưa được đăng ký'
        ];
    }

    public function attributes()
    {
        return [
            'phone' => 'số điện thoại',
            'password' => 'mật khẩu',
        ];
    }
}
