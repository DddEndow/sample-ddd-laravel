<?php

declare(strict_types=1);

namespace Delivery\Infra\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string $hub_id
 * @property string $name
 * @property string $phone_number
 * @property ProductionFactory|null $productionFactory
 * @property Store|null $store
 */
class Hub extends Model
{
    use HasFactory;

    protected $primaryKey = 'hub_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'hub_id',
        'name',
        'phone_number'
    ];

    protected $casts = [
        'hub_id' => 'string',
        'name' => 'string',
        'price' => 'integer'
    ];

    public function productionFactory(): HasOne
    {
        return $this->hasOne(ProductionFactory::class, 'hub_id', 'hub_id');
    }

    public function store(): HasOne
    {
        return $this->hasOne(Store::class, 'hub_id', 'hub_id');
    }

    protected static function newFactory(): Factory
    {
        return \Delivery\Infra\Database\Factories\HubFactory::new();
    }
}
