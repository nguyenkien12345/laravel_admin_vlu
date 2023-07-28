<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdmissionRequest extends FormRequest
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
            'name' => ['required', 'min:3']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Vui lòng nhập :attribute',
            'min' => ':attribute không được nhỏ hơn :min ký tự'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Phương thức tuyển sinh'
        ];
    }
}
