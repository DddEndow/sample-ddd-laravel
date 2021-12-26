<?php

declare(strict_types=1);

namespace Delivery\Infra\Models;

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

    protected $fillable = [
        'route_code',
        'name',
        'production_factory_id'
    ];

    public function productionFactory(): BelongsTo
    {
        return $this->belongsTo(ProductionFactory::class, 'production_factory_id', 'hub_id');
    }

    public function stores(): HasMany
    {
        return $this->hasMany(Store::class, 'route_code', 'route_code');
    }
}
