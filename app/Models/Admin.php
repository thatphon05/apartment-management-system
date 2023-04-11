<?php

namespace App\Models;

use App\Enums\AdminStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
     * @var string[]
     */
    protected $fillable = [
        'remember_token',
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => AdminStatusEnum::class,
    ];

    /**
     * Hash the administrator's password.
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn(mixed $value) => bcrypt($value),
        );
    }
}
