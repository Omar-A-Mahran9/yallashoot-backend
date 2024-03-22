<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $appends = [ 'name','address' ];
    protected $guarded = ['lat','lng'];
    protected $casts  = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d'
    ];

    public function getNameAttribute()
    {
        return $this->attributes[ 'name_' . getLocale() ];
    }

    public function getAddressAttribute()
    {
        return $this->attributes[ 'address_' . getLocale() ];
    }


    public function city()
    {
        return $this->belongsTo( City::class );
    }
}
