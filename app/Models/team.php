<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['title','description','coach_name','country_name'];
    protected $casts   = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d'
    ];

    public function getTitleAttribute()
    {
        return $this->attributes['title_' . getLocale()];
    }

    public function getDescriptionAttribute()
    {
        return $this->attributes['description_' . getLocale()];
    }
    public function country(){
        return  $this->belongsTo(Country::class,'country_id');
    }
    public function coach(){
        return  $this->belongsTo(Coach::class,'coach_id');
    }
    public function getCountryNameAttribute()
    {
        return $this->country->title;
    }
    public function getCoachNameAttribute()
    {
        return $this->coach->name; // Access the coach relationship method instead of property
    }
}
