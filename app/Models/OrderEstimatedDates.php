<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

class OrderEstimatedDates extends Model
{
    use HasFactory;
    protected $fillable =['order_id' ,  'reason' , 'estimated_date' , 'phase'];

    const INITIAL = "INITIAL";
    const CONFIRMED = "CONFIRMED";
    const DELIVERED = "DELIVERED";
    const DELAY = "DELAY";
    const STATUSES = [self::INITIAL , self::CONFIRMED , self::DELIVERED , self::DELAY  ];


    public function order(){
        return $this->belongsTo(Order::class);
    }

}
