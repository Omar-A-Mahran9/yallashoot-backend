<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['name','country_name'];

    protected $casts  = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d'
    ];


    public function getNameAttribute()
    {
        return $this->attributes['name_' . getLocale()];
    }
    public function country(){
        return  $this->belongsTo(Country::class,'country_id');
    }
    public function getCountryNameAttribute()
    {
        return $this->country->title;
    }
}
