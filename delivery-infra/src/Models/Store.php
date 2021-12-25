<?php

declare(strict_types=1);

namespace Delivery\DeliveryInfra;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    use HasFactory;

    protected $primaryKey = 'hub_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'hub_id',
        'basic_information',
        'route_code',
        'delivery_order'
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
}
