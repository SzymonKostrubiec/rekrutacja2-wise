<?php

namespace App\Checker;

use App\Enum\TrustedCityEnum;
use App\Enum\TrustedEmailEnum;

final class CustomerTrustChecker
{
    public function checkCity(string $city): bool
    {
        return in_array($city, array_column(TrustedCityEnum::cases(), 'value'));
    }

    public function checkEmail(string $email): bool
    {
        return in_array($email, array_column(TrustedEmailEnum::cases(), 'value'));
    }
}
