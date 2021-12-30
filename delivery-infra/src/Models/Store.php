<?php

declare(strict_types=1);

namespace Delivery\Infra\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $hub_id
 * @property string $basic_information
 * @property string|null $route_code
 * @property int|null $delivery_order
 * @property Hub $hub
 * @property DeliveryRoute|null $deliveryRoute
 * @property array<Delivery> $deliveries
 * @property array<Order> $orders
 */
class Store extends Model
{
    use HasFactory;

    protected $primaryKey = 'hub_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'hub_id',
        'basic_information',
        'route_code',
        'delivery_order'
    ];

    protected $casts = [
        'hub_id' => 'string',
        'basic_information' => 'string',
        'route_code' => 'string',
        'delivery_order' => 'integer'
    ];

    public function hub(): BelongsTo
    {
        return $this->belongsTo(Hub::class, 'hub_id', 'hub_id');
    }

    public function deliveryRoute(): BelongsTo
    {
        return $this->belongsTo(DeliveryRoute::class, 'route_code', 'route_code');
    }

    public function deliveries(): HasMany
    {
        return $this->hasMany(Delivery::class, 'store_id', 'hub_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'store_id', 'hub_id');
    }

    protected static function newFactory(): Factory
    {
        return \Delivery\Infra\Database\Factories\StoreFactory::new();
    }
}
