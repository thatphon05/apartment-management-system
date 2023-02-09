<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserStatusEnum;
use Carbon\Carbon;
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
        'id_card_number',
        'birthdate',
        'religion',
        'name',
        'surname',
        'address',
        'subdistrict',
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
        'full_address',
        'birth_date_format',
        'age',
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
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'invoice_id');
    }

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->name . ' ' . $this->surname;
    }

    public function getFullAddressAttribute(): string
    {
        return $this->address . ' ' . $this->sub_district . ' ' . $this->district . ' '
            . $this->province . ' ' . $this->postal_code;
    }

    public function getBirthDateFormatAttribute(): string
    {
        return Carbon::parse($this->birthdate)->translatedFormat('l j F Y');
    }

    public function getAgeAttribute(): string
    {
        return Carbon::parse($this->birthdate)->diff(Carbon::now())->format('%y ปี, %m เดือน, %d วัน');
    }
}
