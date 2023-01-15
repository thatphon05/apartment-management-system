<?php

namespace App\Enums;

enum InvoiceStatusEnum: int
{
    case PENDING = 0;
    case COMPLETE = 1;
    case OVERDUE = 2;
    case CANCEL = 3;

}
