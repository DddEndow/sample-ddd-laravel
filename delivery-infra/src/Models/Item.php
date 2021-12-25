<?php

declare(strict_types=1);

namespace Delivery\DeliveryInfra;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;

    protected $primaryKey = 'item_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'item_id',
        'name',
        'price'
    ];

    public function deliveryDetails(): HasMany
    {
        return $this->hasMany(DeliveryDetail::class, 'item_id', 'item_id');
    }

    public function productionDetails(): HasMany
    {
        return $this->hasMany(ProductionDetail::class, 'item_id', 'item_id');
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'item_id', 'item_id');
    }
}
