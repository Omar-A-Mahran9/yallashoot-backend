<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['id','name', 'phone','employee_id','price','nationality_id','identity_no', 'car_name', 'car_id', 'city_id', 'type', 'identity_Card', 'License_Card','Hr_Letter_Image','Insurance_Image','status_id', 'client_id','opened_at','opened_by','birth_date'];
    protected $casts   = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d'
    ];
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class)->withTrashed();
    }

    public function orderDetailsCar()
    {
        return $this->hasOne(CarOrder::class);
    }

    public function bank()
    {
        return $this->hasOne(Bank::class,'id','bank_id');
    }

    public function statusHistory()
    {
        return $this->hasMany( OrderHistory::class)->with('employee');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class,'opened_by');
    }
    public function statue()
    {
        return $this->belongsTo(SettingOrderStatus::class,'status_id');
    }
    
    public function sendOTP()
    {
        $this->verification_code = rand(1111, 9999);
        $appName                 = settings()->getSettings("website_name_" . getLocale()) ?? "CodeCar";
        // $this->sendSMS("$appName: $this->verification_code هو رمز الحماية,لا تشارك الرمز");
        OtpLink($this->phone,$this->verification_code);

        $this->save();
    }

    public function verifyOTP($verification_code)
    {
        if ($this->verification_code === $verification_code)
        {
            $this->verified_at       = now();
            $this->verified       = true;
            $this->verification_code = NULL;
            $this->save();
            return TRUE;
        } else
        {
            return FALSE;
        }
    }

}
