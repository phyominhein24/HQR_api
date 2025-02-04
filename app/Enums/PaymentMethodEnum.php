<?php

namespace App\Enums;

enum PaymentMethodEnum: string
{
    case ONLINE_PAYMENT = 'ONLINE_PAYMENT';
    case CASH = 'CASH';
}
