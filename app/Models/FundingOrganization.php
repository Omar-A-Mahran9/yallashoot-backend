<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundingOrganization extends Model
{
    use HasFactory, SoftDeletes;

    protected $table   = "funding_organizations";
    protected $guarded = [];
    protected $appends = ['name', 'offer'];
    protected $casts   = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d'
    ];

    public function getNameAttribute()
    {
        return $this->attributes['name_' . getLocale() ];

    }

    public function getOfferAttribute()
    {
        return $this->attributes['offer_' . getLocale() ];
    }

    public function carsOrders()
    {
        return $this->hasMany(CarOrder::class);
    }


}
