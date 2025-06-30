<?php

namespace App\Controller;

use App\Action\StoreCustomerAction;
use App\Dto\StoreUserDto;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use OpenApi\Attributes as OA;
use Symfony\Component\Routing\Attribute\Route;

class CustomerController
{
    public function __construct(
        private readonly StoreCustomerAction $storeCustomerAction,
    )
    {
    }

    #[OA\Post(
        path: '/api/customer/new',
        summary: 'Register new customer',
        description: 'Register new customer',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['email'],
                properties: [
                    new OA\Property(
                        property: 'taxNumber',
                        type: 'integer',
                        example: 123
                    ),
                    new OA\Property(
                        property: 'email',
                        type: 'string',
                        format: 'email',
                        example: 'user@example.com'
                    ),
                    new OA\Property(
                        property: 'registeredTradeName',
                        type: 'string',
                        example: 'Janusz'
                    ),
                    new OA\Property(
                        property: 'phone',
                        type: 'string',
                        example: '123456789'
                    ),
                    new OA\Property(
                        property: 'address',
                        type: 'array',
                        items: new OA\Items(
                            type: 'object',
                            properties: [
                                new OA\Property(property: 'street', type: 'string', example: 'ul. Kwiatowa 5'),
                                new OA\Property(property: 'city', type: 'string', example: 'Warszawa'),
                                new OA\Property(property: 'zip', type: 'string', example: '00-001'),
                                new OA\Property(property: 'country', type: 'string', example: 'Polska'),
                            ]
                        ),
                        example: [
                            [
                                'street' => 'ul. Kwiatowa 5',
                                'city' => 'Warszawa',
                                'zip' => '00-001',
                                'country' => 'Polska',
                            ]
                        ]
                    ),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Użytkownik zarejestrowany'
            )
        ]
    )]
    #[Route('/api/customer/new', name: 'register_customer', methods: ['POST'])]
    public function store(#[MapRequestPayload] StoreUserDto $storeUserDto):JsonResponse
    {
        try{
            $user = $this->storeCustomerAction->execute($storeUserDto);
            return new JsonResponse(
                [
                    'success' => true,
                    'message' => sprintf('Successfully created user %s', $user->getEmail())
                ]);
            //own exception
        }catch (\Exception $exception){
            return new JsonResponse(
                [
                    'success' => false,
                    'message' => $exception->getMessage()
                ], 400);
        }

    }
}
