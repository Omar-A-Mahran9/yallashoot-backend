<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturePackage extends Model
{
    use HasFactory;
    protected $fillable = [
        'feature_id',
        'package_id',
        'value',

    ];

    public function feature()
    {
        return $this->hasOne(Feature::class, 'id', 'feature_id');
    }
}
