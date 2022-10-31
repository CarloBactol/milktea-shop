<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'email',
        'phone',
        'address',
        'city',
        'country',
        'postal_code',
        'total_price',
        'shipping',
        'message',
        'distance',
        'tracking_no',
        'payment_mode',
        'payment_id',
    ];

    // HasMany relations
    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
