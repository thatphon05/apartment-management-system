<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{

    /**
     * @var bool
     */
    public $timestamps = true;
    /**
     * @var string
     */
    protected $table = 'configurations';

    protected $fillable = [
        'rent_price',
        'electric_price',
        'water_price',
        'parking_price',
        'common_fee',
        'damages_price'
    ];
}
