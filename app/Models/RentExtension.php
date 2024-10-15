<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentExtension extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'rent_id',
        'extension_period',
        'total',
    ];
}
