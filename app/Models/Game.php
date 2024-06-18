<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['description','team_name_one','team_name_two','country_name','Playground'];
    protected $casts   = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d'
    ];

    public function getDescriptionAttribute()
    {
        return $this->attributes['description_' . getLocale()];
    }

    public function channels()
    {
        return $this->belongsToMany(channel::class);
    }
    public function Team()
    {
        return $this->belongsTo(Team::class,'team_one_id');
    }
    public function getTeamNameOneAttribute()
    {
        return $this->Team->title;
    }

    public function TeamTwo()
    {
        return $this->belongsTo(Team::class,'team_two_id');
    }
    public function getTeamNameTwoAttribute()
    {
        return $this->TeamTwo->title;
    }

    public function country(){
        return  $this->belongsTo(Country::class,'country_id');
    }
    public function getCountryNameAttribute()
    {
        return $this->country->title;
    }

    public function palyground(){
        return  $this->belongsTo(Playground::class,'playground_id');
    }
    public function getPlaygroundAttribute()
    {
        return $this->palyground->title;
    }
}
