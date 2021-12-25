<?php

declare(strict_types=1);

namespace Delivery\DeliveryInfra;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Delivery extends Model
{
    use HasFactory;

    protected $primaryKey = 'delivery_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'delivery_id',
        'store_id',
        'scheduled_delivery_datetime',
        'delivery_completion_datetime'
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id', 'hub_id');
    }

    public function deliveryDetails(): HasMany
    {
        return $this->hasMany(DeliveryDetail::class, 'delivery_id', 'delivery_id');
    }
}
