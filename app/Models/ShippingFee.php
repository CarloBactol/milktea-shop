<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingFee extends Model
{
    use HasFactory;
    protected $table = 'shipping_fees';
    protected $fillable = ['shipping', 'user_id', 'email'];

    public function distance()
    {
        $this->belongsTo(Distance::class, 'user_id', 'user_id');
    }
}
