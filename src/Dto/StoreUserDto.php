<?php

namespace App\Dto;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class StoreUserDto
{
    public function __construct(
        public ?int $taxNumber,
        #[Assert\NotBlank]
        #[Assert\Email]
        public ?string $email,
        public ?string $registeredTradeName,
        #[Assert\Regex( pattern: '/^\+?[0-9]{9,15}$/', message: 'Wrong phone number')]
        #[Assert\Length(min: 9)]
        public ?string $phone,
        /* @var AddressDto[] */
        public ?array $address
    )
    {
    }
}
