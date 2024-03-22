<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankOffer extends Model
{
    use HasFactory;
    protected $guarded =[];
        protected $appends = [ 'title' ];

    protected $casts  = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d'
    ];

    public function sectors()
    {
        return $this->belongsToMany(Sector::class)->withPivot(["benefit", "support", "advance", "installment","administrative_fees"]);
    }
    public function brnads()
    {
        return $this->belongsToMany(Brand::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function detachSectors(){
        $this->sectors()->detach();
    }
    public function attachSectors($pivotData)
    {
 
        $this->sectors()->detach();
        foreach (Sector::get() as $sector) {
            $this->sectors()->attach($sector, [
                "benefit" => $pivotData[$sector->slug]["benefit"],
                "support" => $pivotData[$sector->slug]["support"],
                "advance" => $pivotData[$sector->slug]["advance"],
                "installment" => $pivotData[$sector->slug]["installment"] ,
                "administrative_fees" => $pivotData[$sector->slug]["administrative_fees"] ,
            ]);
        }
    }
    public function getTitleAttribute()
    {
        return $this->attributes[ 'title_' . getLocale() ];
    }
    // public function attachSectors($pivotData)
    // {
    //     $this->sectors()->detach();
    //     foreach (Sector::get() as $sector) {
    //         $this->sectors()->attach($sector, [
    //             "transferred_benefit" => $pivotData[$sector->slug]["transferred_benefit"],
    //             "non_transferred_benefit" => $pivotData[$sector->slug]["non_transferred_benefit"],
    //             "support" => $pivotData[$sector->slug]["support"],
    //             "administrative_fees" => $pivotData[$sector->slug]["administrative_fees"] ,
    //         ]);
    //     }
    // }
    
}
