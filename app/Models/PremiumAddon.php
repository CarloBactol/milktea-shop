<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumAddon extends Model
{
    protected $table = 'premium_addons';
    protected $fillable = ['name'];
}
