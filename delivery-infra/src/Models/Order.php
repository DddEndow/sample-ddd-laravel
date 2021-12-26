<?php

declare(strict_types=1);

namespace Delivery\Infra\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'order_id',
        'store_id',
        'registration_order_datetime',
        'scheduled_delivery_datetime'
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id', 'hub_id');
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }
}
