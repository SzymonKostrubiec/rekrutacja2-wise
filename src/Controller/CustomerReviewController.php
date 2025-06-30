<?php

namespace App\Controller;

use App\Action\AddPointsAction;
use App\Calculator\CustomerQualityPointsCalculator;
use App\Checker\CustomerQualityChecker;
use App\Entity\Customer;
use App\Enum\TrustedEmailEnum;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class CustomerReviewController
{
    public function __construct(
        private CustomerQualityPointsCalculator $customerQualityPointsCalculator,
        private AddPointsAction $addPointsAction,
        private CustomerQualityChecker $customerQualityChecker,
    )
    {
    }

    #[Route('/api/customer/{customer}/review', name: 'add_customer_review', methods: ['POST'])]
    public function store(Customer $customer, ): JsonResponse
    {
        $points = $this->customerQualityPointsCalculator->calc($customer);
        $this->addPointsAction->execute($customer, $points);

        $customerQuality = $this->customerQualityChecker->check($points);

        return new JsonResponse(
            [
                'success' => true,
                'message' => sprintf('Trader review: %s Trader Points: %s', $customerQuality, $points)
            ]
        );
    }
}
