<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserStatusEnum;
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
        'email',
        'telephone',
        'password',
        'id_card',
        'birthdate',
        'religion',
        'name',
        'surname',
        'address',
        'sub_district',
        'district',
        'province',
        'postal_code',
        'id_card_copy',
        'copy_house_registration',
        'status',
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
        'status' => UserStatusEnum::class,
    ];

    /**
     * @var string[]
     */
    protected $appends = [
        'full_name',
    ];

    /**
     * @return HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    /**
     * @return HasMany
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'user_id');
    }

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->name . ' ' . $this->surname;
    }
}
