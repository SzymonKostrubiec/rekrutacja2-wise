<?php

namespace App\Action;

use App\Dto\StoreUserDto;
use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;

final class StoreCustomerAction
{

    public function __construct(
        private EntityManagerInterface $entityManager,
    )
    {
    }

    public function execute(StoreUserDto $storeUserDto): Customer
    {
       $customer =  new Customer();
       $customer->setTaxNumber($storeUserDto->taxNumber);
       $customer->setEmail($storeUserDto->email);
       $customer->setRegisteredTradeName($storeUserDto->registeredTradeName);
       $customer->setPhone($storeUserDto->phone);
       $customer->setAddress($storeUserDto->address);

       $this->entityManager->persist($customer);
       $this->entityManager->flush();

       return $customer;
    }
}
