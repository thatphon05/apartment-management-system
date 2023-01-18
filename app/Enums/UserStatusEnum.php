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
            'INACTIVE', UserStatusEnum::INACTIVE => 'ยกเลิก',
            'ACTIVE', UserStatusEnum::ACTIVE => 'กำลังเช่า',
            default => 'เกิดข้อผิดพลาด'
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
