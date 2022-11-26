<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = ['menu_item_id' , 'order_id' , 'quantity'];

    public function menuItem(){
        return $this->belongsTo(MenuItems::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }



}
