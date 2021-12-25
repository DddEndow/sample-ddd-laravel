<?php

declare(strict_types=1);

namespace Delivery\DeliveryInfra;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Hub extends Model
{
    use HasFactory;

    protected $primaryKey = 'hub_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'hub_id',
        'name',
        'phone_number'
    ];

    public function productionFactory(): HasOne
    {
        return $this->hasOne(ProductionFactory::class, 'hub_id', 'hub_id');
    }

    public function store(): HasOne
    {
        return $this->hasOne(Store::class, 'hub_id', 'hub_id');
    }
}
