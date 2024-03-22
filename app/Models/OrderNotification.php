<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderNotification extends Model
{    use HasFactory;

    protected $fillable=[
        'vendor_id',
        'order_id',
        'ad_id',
        'newstatue',
        'oldstatue',
        'type',
        'is_read',
        'phone',
            ];

    public function  order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }
}
