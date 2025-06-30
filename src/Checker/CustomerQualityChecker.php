<?php

namespace App\Checker;

use App\Enum\CustomerQualityEnum;

final class CustomerQualityChecker
{
    public function check(int $customerPoints): string
    {
        return match (true) {
            $customerPoints >= CustomerQualityEnum::HIGH_QUALITY->value    => 'High Quality',
            $customerPoints >= CustomerQualityEnum::MEDIUM_QUALITY->value => 'Medium Quality',
            default => 'Low Quality',
        };
    }
}
