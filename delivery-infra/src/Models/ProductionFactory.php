<?php

declare(strict_types=1);

namespace Delivery\Infra\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductionFactory extends Model
{
    use HasFactory;

    protected $primaryKey = 'hub_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'hub_id',
        'capacity'
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
}
