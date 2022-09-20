<?php

namespace App\Models;

use App\Models\Size;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['qty', 'name', 'size_id', 'description', 'image', 'status', 'popular',];

    public function bottle_size()
    {
        return  $this->belongsTo(Size::class, 'size_id', 'id',);
    }
}
