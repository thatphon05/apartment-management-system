<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Floor extends Model
{

    /**
     * @var bool
     */
    public $timestamps = true;
    /**
     * @var string
     */
    protected $table = 'floors';

    /**
     * @return HasOne
     */
    public function building(): HasOne
    {
        return $this->hasOne(Building::class, 'building_id');
    }

    /**
     * @return HasMany
     */
    public function room(): HasMany
    {
        return $this->hasMany(Room::class, 'floor_id');
    }

}
