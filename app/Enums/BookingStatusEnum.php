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
            'INACTIVE', self::INACTIVE => 'ยกเลิก',
            'ACTIVE', self::ACTIVE => 'กำลังพัก',
            default => ''
        };
    }

    /**
     * @param $value
     * @return string
     */
    public static function getColor($value): string
    {
        return match ($value) {
            'INACTIVE', self::INACTIVE => 'red',
            'ACTIVE', self::ACTIVE => 'green',
            default => ''
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
