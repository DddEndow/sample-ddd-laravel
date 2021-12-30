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
 * @property int $capacity
 * @property Hub $hub
 * @property DeliveryRoute $deliveryRoute
 * @property array<Production> $productions
 */
class ProductionFactory extends Model
{
    use HasFactory;

    protected $primaryKey = 'hub_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'hub_id',
        'capacity'
    ];

    protected $casts = [
        'hub_id' => 'string',
        'capacity' => 'integer'
    ];

    public function hub(): BelongsTo
    {
        return $this->belongsTo(Hub::class, 'hub_id', 'hub_id');
    }

    public function deliveryRoutes(): HasMany
    {
        return $this->hasMany(DeliveryRoute::class, 'production_factory_id', 'hub_id');
    }

    public function productions(): HasMany
    {
        return $this->hasMany(Production::class, 'production_factory_id', 'hub_id');
    }

    protected static function newFactory(): Factory
    {
        return \Delivery\Infra\Database\Factories\ProductionFactoryFactory::new();
    }
}
