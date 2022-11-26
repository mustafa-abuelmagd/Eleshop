<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierItems extends Model
{
    use HasFactory;
    protected $fillable = ['supplier_id', 'menu_item_id' , 'quantity'];


    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function menuItem(){
        return $this->belongsTo(MenuItems::class);
    }
}
