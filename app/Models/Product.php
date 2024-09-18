<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'merk',
        'color',
        'storage',
        'image',
        'category_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeBestSellingInCategory(Builder $query, $categoryId)
    {
        return $query->where('category_id', $categoryId)
            ->withSum('orderItems', 'quantity')
            ->orderBy('order_items_sum_quantity', 'desc')
            ->take(6); // Ambil 6 produk teratas
    }
}
