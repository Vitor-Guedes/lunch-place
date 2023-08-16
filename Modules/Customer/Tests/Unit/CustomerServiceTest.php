<?php

namespace Modules\Customer\Tests\Unit;

use Illuminate\Support\Arr;
use Tests\TestCase;
use Modules\Customer\Services\CustomerService;

class CustomerServiceTest
extends TestCase
{
    /**
     * @return CustomerService
     */
    protected function getCustomerService() : CustomerService
    {
        return app()->make(CustomerService::class);
    }

    /**
     * Test for retreive customer service instance
     * 
     * @return void
     */
    public function test_should_make_a_instance_from_customer_service()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getCustomerService();
        $expected = \Modules\Customer\Services\CustomerService::class;

        $this->assertInstanceOf($expected, $customerService);
    }

    /**
     * Test for try register customer data and return error message
     * 
     * @return void
     */
    public function test_should_throw_exception_when_try_register_new_customer()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getCustomerService();
        $customerData = config('customer.mocky_test.register_invalid_data', []);

        $responseService = $customerService->register($customerData);

        $this->assertIsArray($responseService);
        $this->assertArrayHasKey('message', $responseService);
    }

    /**
     * Test for try register customer data
     * 
     * @return void
     */
    public function test_should_register_new_customer()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getCustomerService();
        $customerData = config('customer.mocky_test.register_data', []);

        $responseService = $customerService->register($customerData);
        unset($customerData['confirmpassword']);

        $this->assertIsArray($responseService);
        $this->assertArrayHasKey('id', $responseService);
        $this->assertEquals(array_merge(['id'], array_keys($customerData)), array_keys($responseService));
        $this->assertEquals(array_values($customerData), array_values(Arr::except($responseService, ['id'])));
    }

    /**
     * Test for try authenticate customer credentials
     * 
     * @return void
     */
    public function test_should_be_able_to_authenticate()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getCustomerService();
        $credentials = config('customer.mocky_test.authenticate_invalid', []);

        $responseService = $customerService->authenticate($credentials);

        $this->assertIsArray($responseService);
        $this->assertArrayHasKey('token', $responseService);
    }

    /**
     * Test for try authenticate customer credentials with invalid data
     * 
     * @return void
     */
    public function test_not_should_be_able_to_authenticate()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getCustomerService();
        $credentials = config('customer.mocky_test.authenticate', []);

        $responseService = $customerService->authenticate($credentials);

        $this->assertIsArray($responseService);
        $this->assertArrayHasKey('token', $responseService);
    }

    /**
     * Test for try update customer data with invalid data
     * 
     * @return void
     */
    public function test_not_should_able_to_update_customer_data()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getCustomerService();
        $customerData = config('customer.mocky_test.update_data_invalid', []);
        $customerId = random_int(0, 100); // Substituir por Model::inRandomOrder()->first(['id']) // simula id do user logado 

        $responseService = $customerService->update($customerData, $customerId);

        $this->assertIsArray($responseService);
        $this->assertArrayHasKey('message', $responseService);
    }

    /**
     * Test for try update customer data
     * 
     * @return void
     */
    public function test_should_able_to_update_customer_data()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getCustomerService();
        $customerData = config('customer.mocky_test.update_data', ['name' => 'teste']);
        $customerId = random_int(0, 100); // Substituir por Model::inRandomOrder()->first(['id']) // simula id do user logado 

        $responseService = $customerService->update($customerData, $customerId);

        $this->assertIsArray($responseService);
        $this->assertArrayHasKey('id', $responseService);
        $this->assertEquals(array_merge(['id'], array_keys($customerData)), array_keys($responseService));
        $this->assertEquals(array_values($customerData), array_values(Arr::except($responseService, ['id'])));
    }

    /**
     * Test for try update customer password with invalid password value
     * 
     * @return void
     */
    public function test_not_should_be_able_update_customer_password()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getCustomerService();
        $updatePasswordDate = config('customer.mocky_test.update_password');
        $customerId = random_int(0, 100); // Substituir por Model::inRandomOrder()->first(['id'])
        // $password = $updatePasswordDate['password'];
        $password = '';

        $responseService = $customerService->updatePassword($password, $customerId);

        $this->assertIsArray($responseService);
        $this->assertArrayHasKey('message', $responseService);
    }

    /**
     * Test for try update customer password
     * 
     * @return void
     */
    public function test_should_be_able_update_customer_password()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getCustomerService();
        $updatePasswordDate = config('customer.mocky_test.update_password');
        $customerId = random_int(0, 100); // Substituir por Model::inRandomOrder()->first(['id'])
        $password = $updatePasswordDate['password'];

        $responseService = $customerService->updatePassword($password, $customerId);

        $this->assertIsArray($responseService);
        $this->assertArrayHasKey('id', $responseService);
    }

    /**
     * Test for try create customer address with invalid data 
     * 
     * @return void
     */
    public function test_not_should_be_able_create_customer_address_data()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getCustomerService();
        $customerAddressData = config('customer.mocky_test.customer_address_data_invalid', []);
        $customerId = random_int(0, 100); // Substituir por Model::inRandomOrder()->first(['id'])

        $responseService = $customerService->createAddress($customerAddressData, $customerId);

        $this->assertIsArray($responseService);
        $this->assertArrayHasKey('message', $responseService);
    }

    /**
     * Test for try create customer address data
     * 
     * @return void
     */
    public function test_should_be_able_create_customer_address_data()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getCustomerService();
        $customerAddressData = config('customer.mocky_test.customer_address_data.create', []);
        $customerId = random_int(0, 100); // Substituir por Model::inRandomOrder()->first(['id'])

        $responseService = $customerService->createAddress($customerAddressData, $customerId);

        $this->assertIsArray($responseService);
        $this->assertArrayHasKey('id', $responseService);
        $this->assertArrayHasKey('customer_id', $responseService);
        $this->assertEquals(array_merge(['id', 'customer_id'], array_keys($customerAddressData)), array_keys($responseService));
        $this->assertEquals(array_values($customerAddressData), array_values(Arr::except($responseService, ['id', 'customer_id'])));
    }

    /**
     * Test for try update customer address with invalid data 
     * 
     * @return void
     */
    public function test_not_should_be_able_update_customer_address_data()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getCustomerService();
        $customerAddressData = config('customer.mocky_test.customer_address_data_invalid', []);
        $customerId = random_int(0, 100); // Substituir por Model::inRandomOrder()->first(['id'])
        $addressId = random_int(0, 100);

        $responseService = $customerService->updateAddress($customerAddressData, $customerId, $addressId);

        $this->assertIsArray($responseService);
        $this->assertArrayHasKey('message', $responseService);
    }

    /**
     * Test for try update customer address data
     * 
     * @return void
     */
    public function test_should_be_able_update_customer_address_data()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getCustomerService();
        $customerAddressData = config('customer.mocky_test.customer_address_data', []);
        $customerId = random_int(0, 100); // Substituir por Model::inRandomOrder()->first(['id'])
        $addressId = random_int(0, 100);

        $responseService = $customerService->updateAddress($customerAddressData, $customerId, $addressId);

        $this->assertIsArray($responseService);
        $this->assertArrayHasKey('id', $responseService);
        $this->assertEquals(array_merge(['id'], array_keys($customerAddressData)), array_keys($responseService));
        $this->assertEquals(array_values($customerAddressData), array_values(Arr::except($responseService, ['id'])));
    }
}