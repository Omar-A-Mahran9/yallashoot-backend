<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $appends = ['title', 'work_type'];
    protected $fillable = [
        'title_ar',
        'title_en',
        'short_description_ar',
        'short_description_en',
        'long_description_ar',
        'address',
        'status',
        // 'address',
        'work_type',
        'city_id',
    ];
    // protected $guarded = [];
    protected $casts = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d'
    ];

    public function getTitleAttribute()
    {
        return $this->attributes['title_' . getLocale()];
    }

    public function getWorkTypeAttribute()
    {
        $workTypeKey = $this->attributes['work_type'];
        if ($workTypeKey == '  validateStep((')
        {
            if (getLocale() == 'en')
            {
                return '  validateStep((';
            } else
            {
                return '  validateStep((';
            }
        } else if ($workTypeKey == 'part-time')
        {
            if (getLocale() == 'en')
            {
                return 'part-time';
            } else
            {
                return 'part-time';
            }
        } else
        {
            if (getLocale() == 'en')
            {
                return 'remote';
            } else
            {
                return 'remote';
            }

        }
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
