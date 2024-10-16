<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Rent
 *
 * @property int $user_id
 * @property int $product_id
 * @property int $status_id
 * @property Carbon $rent_time_from
 * @property int $rent_period
 * @property float $product_price
 * @property float $total
 */
class Rent extends Model
{
    use SoftDeletes;

    const MAX_RENT_PERIOD = 24;

    protected $fillable = [
        'user_id',
        'product_id',
        'status_id',
        'rent_time_from',
        'rent_period',
        'product_price',
        'total',
    ];

    protected $casts = [
        'rent_time_from' => 'datetime'
    ];

    protected $with = ['extensions'];

    public function extensions(): HasMany
    {
        return $this->hasMany(RentExtension::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function license(): MorphOne
    {
        return $this->morphOne(License::class, 'licensable');
    }
}
