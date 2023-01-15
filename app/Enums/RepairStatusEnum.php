<?php

namespace App\Enums;

enum RepairStatusEnum: int
{
    case PENDING = 0;
    case WAITING = 1;
    case COMPLETE = 2;
    case CANCEL = 3;
}
