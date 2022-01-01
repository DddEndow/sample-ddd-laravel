<?php

declare(strict_types=1);

namespace Delivery\Infra\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $order_id
 * @property string $store_id
 * @property string $registration_order_datetime
 * @property string|null $scheduled_delivery_datetime
 * @property Store $store
 * @property Collection|array<OrderDetail> $orderDetails
 */
class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'store_id',
        'registration_order_datetime',
        'scheduled_delivery_datetime'
    ];

    protected $casts = [
        'order_id' => 'string',
        'store_id' => 'string',
        'registration_order_datetime' => 'string',
        'scheduled_delivery_datetime' => 'string'
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id', 'hub_id');
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }

    protected static function newFactory(): Factory
    {
        return \Delivery\Infra\Database\Factories\OrderFactory::new();
    }
}
