<?php

namespace App\Models;

use App\Models\AddOn;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = ['user_id', 'product_id', 'add_ons_id', 'sugar_level',  'product_qty', 'bottle_size_id'];

    public function product()
    {
        return  $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function add_ons()
    {
        return  $this->belongsTo(AddOn::class);
    }

    public function bottle()
    {
        return  $this->belongsTo(Size::class, 'bottle_size_id', 'id');
    }
}
