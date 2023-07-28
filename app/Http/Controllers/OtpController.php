<?php

namespace App\Http\Controllers;

// Use Resource
use App\Http\Resources\OtpResource;
// Use Repositories
use App\Repositories\OtpRepository;
// Use Services
use App\Services\OtpService;
// Use others
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OtpController
{
    protected $otpRepository;
    protected $otpService;

    public function __construct()
    {
        $this->otpRepository = new OtpRepository();
        $this->otpService = new OtpService();
    }

    public function generateOtp($phone, $type)
    {
        try {
            $otp = $this->otpService->add($phone, $type);
            $data = [
                'phone' => $otp->phone,
                'type' => $otp->type,
            ];
            return $data;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function verifyOtp(Request $request)
    {
        try {
            $phone = $request->input('phone');
            $otp = $request->input('otp');
            $type = $request->input('type');
            $data = $this->otpService->verifyOtp($phone, $otp, $type);
            return $data;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
