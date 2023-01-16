<?php

namespace App\Enums;

enum RepairStatusEnum: int
{
    case NEW = 0;
    case REPORTED = 1;
    case COMPLETE = 2;
    case CANCEL = 3;

    /**
     * @param $value
     * @return string
     */
    public static function getLabel($value): string
    {
        return match ($value) {
            'NEW', 0 => 'ใหม่',
            'PENDING', 1 => 'รอดำเนินการ',
            'OVERDUE', 2 => 'ดำเนินการแล้ว',
            'CANCEL', 3 => 'ยกเลิก',
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
