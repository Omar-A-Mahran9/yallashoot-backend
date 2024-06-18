<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class channel extends Model
{
    use HasFactory;
    protected $table = "channels";
    protected $guarded = [];
    protected $appends = ['title','description','commenter'];
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

    public function getCommenterAttribute()
    {
        return $this->attributes['commenter_name_' . getLocale()];
    }
    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
