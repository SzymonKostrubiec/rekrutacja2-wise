<?php

namespace App\Enum;

enum CustomerQualityPointsEnum
{
    case TAX_NUMBER;
    case EMAIL;
    case TRADER_NAME;
    case ADDRESS;
    case PHONE;
    case TRUSTED_EMAIL;
    case TRUSTED_CITY;

    public function getPoints():int
    {
        return match ($this) {
            self::TAX_NUMBER => 10,
            self::EMAIL => 10,
            self::TRADER_NAME => 5,
            self::ADDRESS => 10,
            self::PHONE => 5,
            self::TRUSTED_EMAIL => 5,
            self::TRUSTED_CITY => 5,
        };
    }
}
