<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model
{
    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $table = 'buildings';

    public function floors(): HasMany
    {
        return $this->hasMany(Floor::class, 'building_id');
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class, 'building_id');
    }
}
