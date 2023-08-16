<?php

namespace Modules\Customer\Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Response;

class CustomerApiTest extends TestCase
{
    /**
     * Test for register customer endpoint.
     *
     * @return void
     */
    public function test_should_return_200_for_register_endpoint()
    {
        $customerData = [];

        $response = $this->post(route('customer.register'), $customerData);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test for register customer endpont when one or more data invalid.
     *
     * @return void
     */
    public function test_should_return_422_for_register_endpoint()
    {
        $customerData = [
            'name' => 'Vitor',
            'email' => 'vtrf2.0'
            // ...
        ];

        $response = $this->post(route('customer.register'), $customerData);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test for authenticate customer endpoint.
     *
     * @return void
     */
    public function test_should_return_200_for_authentication_endpoint()
    {
        $credentials = [];
        
        $response = $this->post(route('customer.authenticate'), $credentials);
        
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test for authenticate customer with invalid credentials
     *
     * @return void
     */
    public function test_should_return_401_for_authentication_endpoint()
    {
        $credentials = [
            'email' => 'vtr@gmail.com',
            'password' => 'asdfljasndf3212'
        ];
        
        $response = $this->post(route('customer.authenticate'), $credentials);
        
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Test for update customer data.
     *
     * @return void
     */
    public function test_should_return_200_for_update_customer_data_endpoint()
    {
        $customerData = [];
        $headers = [
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'customer-token'
        ];
        
        $response = $this->putJson(route('customer.update'), $customerData, $headers);
        
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test for update customer data when one or more data invalid.
     *
     * @return void
     */
    public function test_should_return_422_for_update_customer_data_endpoint()
    {
        $customerData = [
            'name' => '12312',
            'email' => 'foramte.invalido@',
            // ...
        ];
        $headers = [
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'customer-token'
        ];
        
        $response = $this->putJson(route('customer.update'), $customerData, $headers);
        
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test for update customer data when is not logged.
     *
     * @return void
     */
    public function test_should_return_401_for_update_customer_data_endpoint()
    {
        $customerData = [
            'name' => '12312',
            'email' => 'foramte.invalido@',
            // ...
        ];
        
        $response = $this->putJson(route('customer.update'), $customerData);
        
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Test for update customer password.
     *
     * @return void
     */
    public function test_should_return_200_for_update_customer_password_endpoint()
    {
        $customerData = [];
        $headers = [
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'customer-token'
        ];
        
        $response = $this->putJson(route('customer.change-password'), $customerData, $headers);
        
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test for update customer password when one or more data invalid.
     *
     * @return void
     */
    public function test_should_return_422_for_update_customer_password_endpoint()
    {
        $customerData = [
            'password' => 'adasdfadfa212',
            'confirpassword' => 'adasdfadfa212-02',
        ];
        $headers = [
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'customer-token'
        ];
        
        $response = $this->putJson(route('customer.change-password'), $customerData, $headers);
        
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test for update customer password when is not logged.
     *
     * @return void
     */
    public function test_should_return_401_for_update_customer_password_endpoint()
    {
        $customerData = [
            'password' => 'adasdfadfa212',
            'confirpassword' => 'adasdfadfa212-02',
        ];
        $headers = [
            'accept' => 'application/json',
            'content-type' => 'application/json'
        ];
        
        $response = $this->putJson(route('customer.change-password'), $customerData, $headers);
        
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Test for create customer address.
     *
     * @return void
     */
    public function test_should_return_200_for_create_customer_address_endpoint()
    {
        $customerAddressData = [];
        $headers = [
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'customer-token'
        ];
        
        $response = $this->post(route('customer.address.create'), $customerAddressData, $headers);
        
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test for create customer address when one or more data is invalid.
     *
     * @return void
     */
    public function test_should_return_422_for_create_customer_address_endpoint()
    {
        $customerAddressData = [
            'street' => 'Rua tal',
            'number' => '333',
            'city' => '123123',
            // ...
        ];
        $headers = [
            'Authorization' => 'customer-token'
        ];
        
        $response = $this->post(route('customer.address.create'), $customerAddressData, $headers);
        
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test for create customer address when customer .
     *
     * @return void
     */
    public function test_should_return_401_for_create_customer_address_endpoint()
    {
        $customerAddressData = [
            'street' => 'Rua tal',
            'number' => '333',
            'city' => '123123',
            // ...
        ];
        $headers = [
            'accept' => 'application/json',
            'content-type' => 'application/json'
        ];
        
        $response = $this->post(route('customer.address.create'), $customerAddressData, $headers);
        
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Test for create customer address.
     *
     * @return void
     */
    public function test_should_return_200_for_update_customer_address_endpoint()
    {
        $customerAddressData = [];
        $headers = [
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'customer-token'
        ];
        
        $response = $this->post(route('customer.address.update'), $customerAddressData, $headers);
        
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test for create customer address when one or more data is invalid.
     *
     * @return void
     */
    public function test_should_return_422_for_update_customer_address_endpoint()
    {
        $customerAddressData = [
            'street' => 'Rua tal',
            'number' => '333',
            'city' => '123123',
            // ...
        ];
        $headers = [
            'accept' => 'applications/json',
            'Authorization' => 'customer-token'
        ];
        
        $response = $this->post(route('customer.address.update'), $customerAddressData, $headers);
        
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test for create customer address when customer .
     *
     * @return void
     */
    public function test_should_return_401_for_update_customer_address_endpoint()
    {
        $customerAddressData = [
            'street' => 'Rua tal',
            'number' => '333',
            'city' => '123123',
            // ...
        ];
        $headers = [
            'accept' => 'application/json',
            'content-type' => 'application/json'
        ];
        
        $response = $this->post(route('customer.address.update'), $customerAddressData, $headers);
        
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Test for get customer address .
     *
     * @return void
     */
    public function test_should_return_200_for_get_customer_address_endpoint()
    {
        $headers = [
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'customer-token'
        ];
        
        $response = $this->get(route('customer.address.get'), $headers);
        
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test for get customer address when is not logged.
     *
     * @return void
     */
    public function test_should_return_401_for_get_customer_address_endpoint()
    {
        $headers = [
            'accept' => 'application/json',
            'content-type' => 'application/json'
        ];
        
        $response = $this->get(route('customer.address.get'), $headers);
        
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Test for get customer logout .
     *
     * @return void
     */
    public function test_should_return_200_for_get_customer_logout_endpoint()
    {
        $headers = [
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'customer-token'
        ];
        
        $response = $this->get(route('customer.logout'), $headers);
        
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test for get customer logout when is not logged.
     *
     * @return void
     */
    public function test_should_return_401_for_get_customer_logout_endpoint()
    {
        $headers = [
            'accept' => 'application/json',
            'content-type' => 'application/json'
        ];
        
        $response = $this->get(route('customer.logout'), $headers);
        
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }    
}