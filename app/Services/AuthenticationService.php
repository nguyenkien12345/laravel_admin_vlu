<?php

namespace App\Services;

// Use Repositories
use App\Repositories\AuthenticationRepository;
// Use others
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Log;
use Auth;

class AuthenticationService
{
    protected $authenticationRepository;

    public function __construct()
    {
        $this->authenticationRepository = new AuthenticationRepository();
    }

    public function getAll()
    {
        return $this->authenticationRepository->getAll();
    }

    public function find($id)
    {
        return $this->authenticationRepository->find($id);
    }

    public function add($data)
    {
        Log::channel('authentication_history')->info(
            'Add Student Success.', [
                'route' => 'users/store',
                'controller' => 'AuthenticationController',
                'users' => [
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'email' => $data['email']
                ],
                'time' => date('d-m-Y H:i:s')
            ]
        );
        return $this->authenticationRepository->create($data);
    }

    public function signIn($data)
    {
        if(Auth::attempt(['phone' => $data['phone'], 'password' => $data['password']])){
            return true;
        }
        else {
            return false;
        }
    }

    public function sendOtpSMS(Request $request) {
        // VLU
        // $link = config('otpvlu.link');
        // $vtel = substr($phone, 0, 3);
        // $token = config('otpvlu.token');
        // $from = config('otpvlu.from');
        // $telco = config('otpvlu.array_first_3_numbers_phone');
        // $data = [
        //     'to' => $phone,
        //     'from' => $from,
        //     'telco' => $telco[$vtel],
        //     'message' => 'Cam on ban da DKXT Truong DH Van Lang. Ma xac thuc tai khoan (OTP) cua ban la ' . $otp . '. Vi ly do bao mat, ban khong nen chia se ma OTP voi nguoi khac. Than men!',
        //     'scheduled' => '',
        //     'requestId' => '',
        //     'useUnicode' => 0,
        //     'type' => 1
        // ];
        // $data = Http::withToken($token)->post($link, $data);
        // return $data;
    }

    public function resetPassword($data)
    {
        ['phone' => $phone, 'password' => $password, 'password_confirmation' => $password_confirmation] = $data;
        
        $updatedUser = $this->authenticationRepository->checkExists('phone', $phone);

        $updatedData = ['password' => $password];

        $result = $this->authenticationRepository->update($updatedUser->id, $updatedData);
        
        return $result;
    }
}
