<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    #[Groups('customer:data')]
    private ?int $taxNumber = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Groups('customer:data')]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Groups('customer:data')]
    private ?string $registeredTradeName = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups('customer:data')]
    private ?string $phone = null;

    #[ORM\Column(nullable: true)]
    #[Groups('customer:data')]
    private ?array $address = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaxNumber(): ?int
    {
        return $this->taxNumber;
    }

    public function setTaxNumber(?int $TaxNumber): static
    {
        $this->taxNumber = $TaxNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getRegisteredTradeName(): ?string
    {
        return $this->registeredTradeName;
    }

    public function setRegisteredTradeName(string $registeredTradeName): static
    {
        $this->registeredTradeName = $registeredTradeName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?array
    {
        return $this->address;
    }

    public function setAddress(?array $Address): static
    {
        $this->address = $Address;

        return $this;
    }
}
