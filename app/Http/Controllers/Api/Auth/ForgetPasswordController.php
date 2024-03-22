<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Site\SendOtpRquest;
use App\Http\Requests\Site\ResetPasswordRquest;

class ForgetPasswordController extends Controller
{
    public function sendOtp(SendOtpRquest $request)
    {
        $phone=convertArabicNumbers($request->phone);

        $vendor = Vendor::where('phone', $phone)->first();
        if($vendor){
            $vendor->sendOTP();
            // OtpLink(  $vendor->phone, $vendor->verification_code);

            return $this->success(data: ['verification_code' => '-']);
        }
        else{
            return $this->validationFailure(errors: ['phone'=>[__('This phone number is not registered')]]);
        }
    }
    public function verifyOtp(Request $request)
    {
        $phone=convertArabicNumbers($request->phone);

        $vendor = Vendor::where('phone', $phone)->first();
        $result = $vendor->verifyOTP($request->otp);
        return $result ? $this->success() : $this->validationFailure(errors: __('wrong code'));
    }
    public function resendOtp(SendOtpRquest $request)
    {
         $phone=convertArabicNumbers($request->phone);
         $vendor = Vendor::where('phone', $phone)->first();
        $vendor->sendOTP();
        // OtpLink(  $vendor->phone, $vendor->verification_code);

        return $this->success(data: ['verification_code' =>  '-']);
    }
    public function resetPassword(ResetPasswordRquest $request)
    {
        $phone=convertArabicNumbers($request->phone);

         if (
            Vendor::where('phone', $phone)->update([
                'password' => Hash::make($request->password)
            ])
        )
        {
            return $this->success();
        } else
        {
            return $this->failure(message: __('wrong update please try again'));
        }
    }
}
