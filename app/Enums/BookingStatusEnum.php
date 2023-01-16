<?php

namespace App\Enums;

enum BookingStatusEnum: int
{
    case INACTIVE = 0;
    case ACTIVE = 1;

    /**
     * @param $value
     * @return string
     */
    public static function getLabel($value): string
    {
        return match ($value) {
            'INACTIVE', 0 => 'ระงับ',
            'ACTIVE', 1 => 'ใช้งาน',
        };
    }

    /**
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
