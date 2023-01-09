<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'users';
    /**
     * @var bool
     */
    public $timestamps = true;


    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    /**
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * @var string[]
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function roomBookings(): HasMany
    {
        return $this->hasMany(RoomBooking::class, 'user_id');
    }
}
