<?php

namespace App\Calculator;

use App\Checker\CustomerTrustChecker;
use App\Entity\Customer;
use App\Enum\CustomerQualityPointsEnum;

final class CustomerQualityPointsCalculator
{
    public function __construct(
        private readonly CustomerTrustChecker $customerTrustChecker,
    )
    {
    }

    public function calc(Customer $customer):int
    {
        $points = 0;
        $points += $customer->getTaxNumber() ? CustomerQualityPointsEnum::TAX_NUMBER->getPoints() : 0;
        $points += $customer->getEmail() ? CustomerQualityPointsEnum::EMAIL->getPoints() : 0;
        $points += $customer->getPhone() ? CustomerQualityPointsEnum::TRADER_NAME->getPoints() : 0;
        $points += $customer->getAddress() ? CustomerQualityPointsEnum::ADDRESS->getPoints() : 0;
        $points += $customer->getPhone() ? CustomerQualityPointsEnum::PHONE->getPoints() : 0;

        $points += $this->trustedEmailPoints($customer->getEmail());
        $points += $this->trustedCityPoints($customer->getAddress());

        return $points;
    }


    private function trustedEmailPoints(string $email):int
    {
        $email = substr(strchr($email, '@'), 1);
        return $this->customerTrustChecker->checkEmail($email) ? CustomerQualityPointsEnum::TRUSTED_EMAIL->getPoints() : 0;
    }

    private function trustedCityPoints(array $addresses):int{
        $points = 0;
        foreach ($addresses as $address){
            if(!empty($address['city'])){
               $points += $this->customerTrustChecker->checkCity($address['city']) ? CustomerQualityPointsEnum::TRUSTED_CITY->getPoints() : 0;
            }
        }
        return $points;
    }
}
