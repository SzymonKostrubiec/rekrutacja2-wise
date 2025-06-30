<?php

namespace App\Action;

use App\Entity\Customer;
use App\Entity\CustomerReview;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

final class AddPointsAction
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    )
    {
    }

    public function execute(Customer $customer, int $points): Customer
    {
        $review = $customer->getCustomerReview() ?? new CustomerReview();
        $review->setCustomer($customer);
        $review->setPoints($points);
        $this->entityManager->persist($review);
        $this->entityManager->flush();

        return $customer;
    }
}
