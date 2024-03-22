<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    use HasFactory;
    protected $appends = [ 'name' ];
    protected $guarded = [];
    protected $casts   = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d'
    ];

    public function getNameAttribute()
    {
         $locale = getLocale();
        $key = 'name_' . $locale;
 
        return $this->attributes[$key];
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

}
