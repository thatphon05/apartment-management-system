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
            'NEW', RepairStatusEnum::NEW => 'ใหม่',
            'PENDING', RepairStatusEnum::PENDING => 'กำลังดำเนินการ',
            'COMPLETE', RepairStatusEnum::COMPLETE => 'ดำเนินการแล้ว',
            'CANCEL', RepairStatusEnum::CANCEL => 'ยกเลิก',
        };
    }

    /**
     * @param $value
     * @return string
     */
    public static function getColor($value): string
    {
        return match ($value) {
            'NEW', RepairStatusEnum::NEW => 'yellow',
            'PENDING', RepairStatusEnum::PENDING => 'azure',
            'COMPLETE', RepairStatusEnum::COMPLETE => 'green',
            'CANCEL', RepairStatusEnum::CANCEL => '',
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
