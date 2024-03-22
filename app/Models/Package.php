<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'monthly_price',
        'annual_price',
        'monthly_price_after_discount',
        'annual_price_after_discount',
        'discount_from_date',
        'discount_to_date',
    ];
    protected $casts   = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d'
    ];

    public function getNameAttribute()
    {
        return $this->attributes['name_' . getLocale()];
    }
    public function features()
    {
        return $this->hasMany(FeaturePackage::class, 'package_id', 'id');
    }

    public function feature()
    {
        return $this->belongsToMany(Feature::class, 'feature_packages')->withPivot('value');
    }
}
