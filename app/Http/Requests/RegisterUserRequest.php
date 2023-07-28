<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class RegisterUserRequest extends FormRequest
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
            'name' => ['required'],
            'phone' => ['required', 'regex:/^(09|03|07|08|05)+([0-9]{8}$)/', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Vui lòng nhập :attribute vào mục này',
            'email' => 'Định dạng email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'phone.regex' => 'Định dạng số điện thoại không hợp lệ',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'password.confirmed' => 'Mật khẩu không trùng khớp'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'họ và tên',
            'phone' => 'số điện thoại',
            'password' => 'mật khẩu',
            'password_confirmation' => 'mật khẩu xác thực'
        ];
    }
}
