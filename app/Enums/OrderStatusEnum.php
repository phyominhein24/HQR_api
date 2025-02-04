<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case ORDERING = 'ORDERING';
    case CONFIRM = 'CONFIRM';
    case CANCEL = 'CANCEL';
    case COMPLETE = 'COMPLETE';
}
