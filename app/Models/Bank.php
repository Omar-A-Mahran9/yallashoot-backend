<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $guarded = ["government", "military", "sector4"];
    protected $appends = [ 'name' ];
    protected $casts   = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d'
    ];

    public function getNameAttribute()
    {
        return $this->attributes[ 'name_' . getLocale() ];
    }

    public function sectors()
    {
                return $this->belongsToMany(Sector::class)->withPivot(["transferred_benefit","benefit", "support", "administrative_fees"]);

        // return $this->belongsToMany(Sector::class)->withPivot(["transferred_benefit", "non_transferred_benefit", "support", "administrative_fees"]);
    }

    public function offers(){
        return $this->hasMany(BankOffer::class);
    }

    public function attachSectors($pivotData)
    {
        $this->sectors()->detach();
        foreach (Sector::get() as $sector) {
            $this->sectors()->attach($sector, [
                "benefit" => $pivotData[$sector->slug]["benefit"],
                "transferred_benefit" => $pivotData[$sector->slug]["transferred_benefit"],
                // "non_transferred_benefit" => $pivotData[$sector->slug]["non_transferred_benefit"],
                "support" => $pivotData[$sector->slug]["support"],
                "administrative_fees" => $pivotData[$sector->slug]["administrative_fees"] ,
            ]);
        }
    }

}
