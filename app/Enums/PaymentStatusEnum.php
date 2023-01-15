<?php

namespace App\Enums;

enum PaymentStatusEnum: int
{
    case PENDING = 0;
    case COMPLETE = 1;
    case FAILED = 2;
}
