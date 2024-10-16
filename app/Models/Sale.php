<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Sale
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property float $price
 * @property float $total
 */
class Sale extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'product_id',
        'price',
        'total',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function license(): MorphOne
    {
        return $this->morphOne(License::class, 'licensable');
    }
}
