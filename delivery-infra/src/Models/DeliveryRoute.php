<?php

declare(strict_types=1);

namespace Delivery\Infra\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeliveryRoute extends Model
{
    use HasFactory;

    protected $primaryKey = 'route_code';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'route_code',
        'name',
        'production_factory_id'
    ];

    protected $casts = [
        'route_code' => 'string',
        'name' => 'string',
        'production_factory_id' => 'string'
    ];

    public function productionFactory(): BelongsTo
    {
        return $this->belongsTo(ProductionFactory::class, 'production_factory_id', 'hub_id');
    }

    public function stores(): HasMany
    {
        return $this->hasMany(Store::class, 'route_code', 'route_code');
    }

    protected static function newFactory(): Factory
    {
        return \Delivery\Infra\Database\Factories\DeliveryRouteFactory::new();
    }
}
