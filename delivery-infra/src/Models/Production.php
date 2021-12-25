<?php

declare(strict_types=1);

namespace Delivery\DeliveryInfra;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Production extends Model
{
    use HasFactory;

    protected $primaryKey = 'production_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'production_id',
        'production_factory_id',
        'scheduled_creation_datetime',
        'creation_completion_datetime'
    ];

    public function productionFactory(): BelongsTo
    {
        return $this->belongsTo(ProductionFactory::class, 'production_factory_id', 'hub_id');
    }

    public function deliveryDetails(): HasMany
    {
        return $this->hasMany(ProductionDetail::class, 'production_id', 'production_id');
    }
}
