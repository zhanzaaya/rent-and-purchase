<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $category_id
 * @property string $description
 * @property float $price
 * @property float $hourly_rent_price
 * @property bool $is_active
 * @property string $preview_path
 * @property int $stock_quantity
 * @property int $rental_stock_quantity
 */
class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'category_id',
        'description',
        'price',
        'hourly_rent_price',
        'is_active',
        'preview_path',
        'stock_quantity',
        'rental_stock_quantity',
    ];
}
