<?php

namespace App\Http\Controllers;

// Use Request
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\ForgotPasswordUserRequest;
use App\Http\Requests\ResetPasswordRequest;
// Use Repositories
use App\Repositories\AuthenticationRepository;
// Use Services
use App\Services\AuthenticationService;
// Use Controllers
use App\Http\Controllers\OtpController;
// Use Common
use App\Helpers\FormatResponse;
// Use others
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;

class AuthenticationController
{
    public $authenticationRepository;
    public $authenticationService;
    public $otpController;

    public function __construct()
    {
        // __construct Repositories
        $this->authenticationRepository = new AuthenticationRepository();
        // __construct Services
        $this->authenticationService = new AuthenticationService();
        // __construct Controllers
        $this->otpController = new OtpController();
    }

    public function register()
    {
        try {
            return view('Authentication.register');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $dataRegister = session('dataRegister');
            $this->authenticationService->add($dataRegister);
            $request->session()->flush();
            DB::commit();
            return redirect()->route('users.notification-register')->with('success', config('messages.register_success')[0]);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function notificationRegister()
    {
        try {
            return view('Authentication.notification_register');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function login()
    {
        try {
            return view('Authentication.login');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function signIn(LoginUserRequest $request)
    {
        $data = $request->only(['phone', 'password']);
        try {
            $result = $this->authenticationService->signIn($data);
            if ($result) {
                return redirect()->route('/');
            } else {
                return back()->with('error-password', 'Mật khẩu không hợp lệ');
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function forgotPassword()
    {
        try {
            return view('Authentication.forgot_password');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function sendOtp(Request $request)
    {
        $rules = [];
        $messages = [];
        if ($request->type === config('authentication.send_otp.forgot_password')) {
            $rules = [
                'phone' => ['required', 'regex:/^(09|03|07|08|05)+([0-9]{8}$)/', 'exists:users,phone']
            ];
            $messages = [
                'required' => 'Vui lòng nhập số điện thoại vào mục này',
                'phone.regex' => 'Định dạng số điện thoại không hợp lệ',
                'exists' => 'Số điện thoại chưa được đăng ký'
            ];
        } else if ($request->type === config('authentication.send_otp.register')) {
            $rules = [
                'name' => ['required'],
                'phone' => ['required', 'regex:/^(09|03|07|08|05)+([0-9]{8}$)/', 'unique:users'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'confirmed'],
                'password_confirmation' => ['required']
            ];
            $messages = [
                'name.required' => 'Vui lòng nhập họ và tên vào mục này',

                'phone.required' => 'Vui lòng nhập số điện thoại vào mục này',
                'phone.regex' => 'Định dạng số điện thoại không hợp lệ',
                'phone.unique' => 'Số điện thoại đã tồn tại',

                'email.required' => 'Vui lòng nhập email vào mục này',
                'email' => 'Định dạng email không hợp lệ',
                'email.unique' => 'Email đã tồn tại',

                'password.required' => 'Vui lòng nhập mật khẩu vào mục này',
                'password.confirmed' => 'Mật khẩu không trùng khớp',

                'password_confirmation.required' => 'Vui lòng nhập mật khẩu xác thực vào mục này',
            ];
        }
        $request->validate($rules, $messages);

        if ($request->type === config('authentication.send_otp.register')) {
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation,
                'type' => $request->type
            ];
            session(['dataRegister' => $data]);
        }
        try {
            $otp =  $this->otpController->generateOtp($request->phone, $request->type);
            if ($otp) {
                return FormatResponse::formatResponse('success', $otp);
            } else {
                return FormatResponse::formatResponse('fail');
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function showFormVerifyOtp(Request $request)
    {
        try {
            $phone = $request->input('phone');
            $type = $request->input('type');
            return view('Authentication.send_otp')->with('phone', $phone)->with('type', $type);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function verifyOtp(Request $request)
    {
        $rules = ['otp' => ['required']];

        $messages = [
            'required' => 'Vui lòng nhập mã otp vào mục này',
        ];

        $request->validate($rules, $messages);

        try {
            $data = $this->otpController->verifyOtp($request);
            if ($data['code'] === 1) {
                return FormatResponse::formatResponse('success', $data, $data['message']);
            } else {
                return FormatResponse::formatResponse('fail', $data, $data['message']);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function showFormResetPassword(Request $request)
    {
        try {
            $phone = $request->input('phone');
            return view('Authentication.reset_password')->with('phone', $phone);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function resetPassword(Request $request)
    {
        $rules = [
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required']
        ];
        $messages = [
            'password.required' => 'Vui lòng nhập mật khẩu vào mục này',
            'password_confirmation.required' => 'Vui lòng nhập mật khẩu xác thực vào mục này',
            'password.confirmed' => 'Mật khẩu không trùng khớp'
        ];
        $request->validate($rules, $messages);
        try {
            $data = [
                'phone' => $request->phone,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation
            ];
            $result = $this->authenticationService->resetPassword($data);
            if ($result === true) {
                return FormatResponse::formatResponse('success', null, 'Cập nhật mật khẩu thành công');
            } else {
                return FormatResponse::formatResponse('fail', null, 'Cập nhật mật khẩu thất bại');
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
