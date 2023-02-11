<?php

namespace App\Enums;

enum RepairStatusEnum: int
{
    case NEW = 0;
    case PENDING = 1;
    case COMPLETE = 2;
    case CANCEL = 3;

    /**
     * @param $value
     * @return string
     */
    public static function getLabel($value): string
    {
        return match ($value) {
            'NEW', self::NEW => 'ใหม่',
            'PENDING', self::PENDING => 'กำลังดำเนินการ',
            'COMPLETE', self::COMPLETE => 'ดำเนินการแล้ว',
            'CANCEL', self::CANCEL => 'ยกเลิก',
        };
    }

    /**
     * @param $value
     * @return string
     */
    public static function getColor($value): string
    {
        return match ($value) {
            'NEW', self::NEW => 'yellow',
            'PENDING', self::PENDING => 'azure',
            'COMPLETE', self::COMPLETE => 'green',
            'CANCEL', self::CANCEL => '',
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
