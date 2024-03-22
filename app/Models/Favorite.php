<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_id',
        'car_id',
        'device_ip'
    ];

    public function car() {
        return $this->belongsTo(Car::class);
    }
}
