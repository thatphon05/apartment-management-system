<?php

namespace App\Enums;

enum UserStatusEnum: int
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
            'INACTIVE', UserStatusEnum::INACTIVE => 'ระงับ',
            'ACTIVE', UserStatusEnum::ACTIVE => 'ใช้งานได้',
            default => ''
        };
    }

    public static function getColor($value): string
    {
        return match ($value) {
            'INACTIVE', UserStatusEnum::INACTIVE => 'red',
            'ACTIVE', UserStatusEnum::ACTIVE => 'green',
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
