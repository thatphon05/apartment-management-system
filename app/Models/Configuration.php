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
        'name',
        'rent_fee',
        'electric_fee',
        'water_fee',
        'parking_fee',
        'common_fee',
        'overdue_fee',
    ];
}
