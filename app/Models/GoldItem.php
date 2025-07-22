<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoldItem extends Model
{
    protected $fillable = [
    'category_id',
    'subcategory_id',
    'name',
    'price',
    'discount',     // ✅ added
    'weight',
    'purity',
    'description',
    'image',        // ✅ added
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
