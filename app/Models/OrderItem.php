<?php

namespace App\Models;

use App\Models\AddOn;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    protected $fillable = ['order_id',  'product_id', 'sugar_level', 'add_ons', 'qty', 'price'];

    public function product()
    {
        return  $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function add_ons()
    {
        return  $this->belongsTo(AddOn::class, 'add_ons', 'id');
    }
}
