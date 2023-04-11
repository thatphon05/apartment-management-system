<?php

namespace App\Enums;

enum AdminStatusEnum: int
{
    case INACTIVE = 0;
    case ACTIVE = 1;

    public static function getLabel(self|string $value): string
    {
        return match ($value) {
            'INACTIVE', self::INACTIVE => 'ระงับ',
            'ACTIVE', self::ACTIVE => 'ใช้งานได้',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
