<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League_category extends Model
{
    use HasFactory;
    protected $appends = ['name'];
    protected $fillable = [
        'name_ar', 'name_en', // Assuming your columns are named 'name_ar' and 'name_en'
    ];

    public function getNameAttribute()
    {
        return $this->attributes['name_' . getLocale() ];

    }
}
