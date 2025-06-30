<?php

namespace App\Entity;

use App\Repository\CustomerReviewRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerReviewRepository::class)]
class CustomerReview
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'customerReview', cascade: ['persist', 'remove'])]
    private ?Customer $customer = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $points = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getPoints(): ?string
    {
        return $this->points;
    }

    public function setPoints(?string $points): static
    {
        $this->points = $points;

        return $this;
    }
}
