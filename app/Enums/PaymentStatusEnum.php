<?php

namespace App\Enums;

enum PaymentStatusEnum: int
{
    case PENDING = 0;
    case COMPLETE = 1;
    case CANCEL = 2;

    /**
     * @param $value
     * @return string
     */
    public static function getLabel($value): string
    {
        return match ($value) {
            'PENDING', PaymentStatusEnum::PENDING => 'รอตรวจสอบ',
            'COMPLETE', PaymentStatusEnum::COMPLETE => 'ชำระเงินแล้ว',
            'CANCEL', PaymentStatusEnum::CANCEL => 'ยกเลิก',
            default => 'ผิดพลาด',
        };
    }

    /**
     * @param $value
     * @return string
     */
    public static function getColor($value): string
    {
        return match ($value) {
            'PENDING', PaymentStatusEnum::PENDING => 'azure',
            'COMPLETE', PaymentStatusEnum::COMPLETE => 'green',
            'CANCEL', PaymentStatusEnum::CANCEL => '',
            default => '',
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
