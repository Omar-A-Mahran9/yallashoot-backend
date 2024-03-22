<?php

namespace App\Http\Controllers\Api\Auth;

use App\Enums\VendorStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{

    public function resefndOtp(Request $request)
    {
        $phone=convertArabicNumbers($request->phone);
         $user = Vendor::where('phone',$phone)->first();
        $user->sendOTP();
        return $this->success(data: ['verification_code' => '-']);
    }

    public function verifyOtp(Request $request)
    {
        $phone=convertArabicNumbers($request->phone);
        $user = Vendor::where('phone',$phone)->first();
        $result = $user->verifyOTP($request->otp);
        if($user->status==2 || $user->status==1){
            $user->status = VendorStatus::approved->value;
        }
        $user->save();

        return $result ? $this->success() : $this->validationFailure(errors: __('wrong code'));
    }
}
