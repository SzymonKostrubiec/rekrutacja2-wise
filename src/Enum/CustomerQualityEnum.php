<?php

namespace App\Enum;

enum CustomerQualityEnum: int
{
    case HIGH_QUALITY = 35;
    case MEDIUM_QUALITY = 20;
    case LOW_QUALITY = 0;
}
