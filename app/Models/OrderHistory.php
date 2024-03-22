<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "order_histories";

    public function employee()
    {
        return $this->belongsTo(Employee::class)->select('id','name');
    }


    public function assign()
    {
        return $this->belongsTo(Employee::class, 'assign_to', 'id');
    }
}
