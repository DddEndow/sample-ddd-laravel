<?php

declare(strict_types=1);

namespace Delivery\Infra\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductionDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'production_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'production_id',
        'item_id',
        'output'
    ];

    public function production(): BelongsTo
    {
        return $this->belongsTo(Production::class, 'production_id', 'production_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'item_id');
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'production_id', 'production_id');
    }
}
