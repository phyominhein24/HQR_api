<?php

namespace App\Enums;

enum RoomServiceTypeEnum: string
{
    case DOBY = 'DOBY';
    case CLEANING = 'CLEANING';
    case CHECKOUT = 'CHECKOUT';
    case FOOD_ORDER = 'FOOD_ORDER';
    case CAR_RENDAL = 'CAR_RENDAL';
}
