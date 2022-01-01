<?php

declare(strict_types=1);

namespace Delivery\Infra\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $order_id
 * @property string $order_detail_id
 * @property string $item_id
 * @property string|null $production_id
 * @property string|null $delivery_id
 * @property int $quantity
 * @property Order $order
 * @property Item $item
 * @property DeliveryDetail $deliveryDetail
 * @property ProductionDetail $productionDetail
 */
class OrderDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'order_detail_id',
        'item_id',
        'production_id',
        'delivery_id',
        'quantity'
    ];

    protected $casts = [
        'order_id' => 'string',
        'order_detail_id' => 'string',
        'item_id' => 'string',
        'production_id' => 'string',
        'delivery_id' => 'string',
        'quantity' => 'integer'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'item_id');
    }

    public function deliveryDetail(): BelongsTo
    {
        return $this->belongsTo(DeliveryDetail::class, 'delivery_id', 'delivery_id');
    }

    public function productionDetail(): BelongsTo
    {
        return $this->belongsTo(ProductionDetail::class, 'production_id', 'production_id');
    }

    protected static function newFactory(): Factory
    {
        return \Delivery\Infra\Database\Factories\OrderDetailFactory::new();
    }
}
