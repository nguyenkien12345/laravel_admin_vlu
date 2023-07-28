<?php

namespace App\Services;

// Use Repositories
use App\Repositories\OtpRepository;
// Use Models
use App\Models\Otp;
// Use Common
use App\Helpers\Common;
// Use others
use Illuminate\Http\Request;
use Carbon\Carbon;

class OtpService
{
    protected $otpRepository;

    public function __construct()
    {
        $this->otpRepository = new OtpRepository();
    }

    public function add($phone, $type)
    {
        $otp = Otp::where('phone', $phone)->latest()->first();

        $now = Carbon::now();

        $data = null;

        // Nếu otp tồn tại và otp vẫn còn hạn sử dụng
        if($otp && $now->isBefore($otp->expire_at)){
            $data = $otp;
        }
        else {
            $newOtp = [
                'phone' => $phone,
                'otp' => Common::randomOTP(),
                'type' => $type,
                'expire_at' => Carbon::now()->addMinute(1),
            ];
            $data = $this->otpRepository->create($newOtp);
        }

        return $data;
    }

    public function verifyOtp($phone, $otp, $type){
        $otp = Otp::where('phone', $phone)->where('otp', $otp)->latest()->first();

        $now = Carbon::now();

        $messageUnCorrectOTP = config('errorcodes.otp.message.not_correct');
        $codeUnCorrectOTP = config('errorcodes.otp.code.not_correct');

        $messageExpiredOTP = config('errorcodes.otp.message.expired');
        $codeExpiredOTP = config('errorcodes.otp.code.expired');

        $messageSuccessOTP = config('errorcodes.otp.message.success');
        $codeSuccessOTP = config('errorcodes.otp.code.success');

        if(!$otp) {
            $data = ['message' => $messageUnCorrectOTP, 'code' => $codeUnCorrectOTP, 'type' => $type];
        }
        else if ($otp && $now->isAfter($otp->expire_at)){
            $data = ['message' => $messageExpiredOTP, 'code' => $codeExpiredOTP, 'type' => $type];
        }
        else if ($otp && $now->isBefore($otp->expire_at)){
            $otp->delete();
            $data = ['message' => $messageSuccessOTP, 'code' => $codeSuccessOTP, 'type' => $type];
        }

        return $data;
    }
}
