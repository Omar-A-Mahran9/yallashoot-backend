<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizationactive extends Model
{
    use HasFactory;
    protected $table = 'organization_active'; // Explicitly define the table name if needed
    protected $appends = [ 'title' ];

    protected $fillable = [
        'title_ar',
        'title_en',
        // Add more fillable fields as needed
    ];
 
    public function getTitleAttribute()
    {
        return $this->attributes['title_' . getLocale() ];

    }
 
}
