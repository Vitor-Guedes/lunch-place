<?php

$facker = Faker\Factory::create();

$authEmail = $facker->email;
$authPassword = $facker->password(6, 20);

return [
    'mocky_test' => [
        'register_invalid_data' => [
            'name' => $facker->firstName(),
            'sobrenome' => $facker->lastName(),
            'email' => $facker->email,
            'password' => $facker->password(),
            'confirmpassword' => $facker->password(),
        ],
        'register_data' => [
            'name' => $facker->firstName(),
            'sobrenome' => $facker->lastName(),
            'sobrenome' => $facker->name,
            'email' => $authEmail,
            'password' => $authPassword,
            'confirmpassword' => $authPassword,
        ],
        'authenticate_invalid' => [
            'email' => $facker->email,
            'password' => $facker->password
        ],
        'authenticate' => [
            'email' => $authEmail,
            'password' => $authPassword
        ],
        'udpate_data_invalid' => [
            
        ],
        'update_data' => [
            'sobrenome' => $facker->lastName()
        ],
        'update_password' => [
            'password' => $facker->password()
        ],
        'customer_address_data' => [
            'create' => [
                'street' => $facker->streetName,
                'number' => $facker->buildingNumber,
                'city' => $facker->city,
                'state' => $facker->state,
                'complement' => random_int(0, 1) ? $facker->secondaryAddress : '',
                'neighborhood' => $facker->name
            ],
            'update' => [
                'street' => $facker->streetName,
                'number' => $facker->buildingNumber
            ]
        ]
    ]
];