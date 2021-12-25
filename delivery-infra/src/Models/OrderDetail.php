<?php

declare(strict_types=1);

namespace Delivery\DeliveryInfra;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'order_id',
        'item_id',
        'production_id',
        'delivery_id',
        'quantity'
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
}
