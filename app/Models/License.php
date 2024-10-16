<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class License
 *
 * @property int $user_id
 * @property int $product_id
 * @property string $key
 * @property string $expires_at
 * @property int $licensable_id
 * @property string $licensable_type
 */
class License extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'key',
        'expires_at',
        'licensable_id',
        'licensable_type',
    ];

    public function licensable(): MorphTo
    {
        return $this->morphTo();
    }

    public function licensableName(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => strtolower(basename($attributes['licensable_type'])),
        );
    }
}
