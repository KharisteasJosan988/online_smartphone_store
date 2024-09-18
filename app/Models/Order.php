<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'courier_id',
        'no_pesanan',
        'alamat_pengiriman',
        'metode_pembayaran',
        'total_jumlah',
        'shipping_cost',
        'estimated_delivery',
        'status',
        'courier', // Nama kurir sebagai string
    ];

    protected $casts = [
        'estimated_delivery' => 'datetime', // Konversi otomatis ke objek Carbon
    ];


    /**
     * Relasi ke User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Courier
     */
    public function courier()
    {
        return $this->belongsTo(Courier::class, 'courier_id');
    }

    /**
     * Relasi ke OrderItem
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedEstimatedDeliveryAttribute()
    {
        return $this->estimated_delivery
            ? $this->estimated_delivery->format('d-m-Y')
            : 'Belum tersedia';
    }
}
