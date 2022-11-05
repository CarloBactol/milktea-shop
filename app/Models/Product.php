<?php

namespace App\Models;

use App\Models\Size;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['qty', 'name', 'size_id', 'description', 'image', 'status', 'popular', 'category_id'];

    public function bottle()
    {
        return  $this->belongsTo(Size::class, 'size_id', 'id');
    }

    public function categories()
    {
        return  $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
