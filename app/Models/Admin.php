<?php

namespace App\Models;

use App\Enums\AdminStatusEnum;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * @var bool
     */
    public $timestamps = true;
    /**
     * @var string
     */
    protected $table = 'admins';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => AdminStatusEnum::class,
    ];
}
