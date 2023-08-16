<?php

namespace Modules\Customer\Services;

use Modules\Ultils\Services\Api\HandlerService;

class CustomerService
extends HandlerService
{
    /**
     * @param array|Request $request
     * 
     * @return array
     */
    public function register(array $request = []) : array
    {
        if ($request && $request['password'] == $request['confirmpassword']) {
            // $model->create($request)
            unset($request['confirmpassword']);
            return array_merge(['id' => random_int(0, 100)], $request);
        }

        return [
            'message' => 'Falha ao tentar registart'
        ];
    }

    /**
     * @param array $credentials
     * 
     * @return array
     */
    public function authenticate(array $credentials = []) : array
    {
        if ($credentials) {
            return [
                'token' => 'customer-token'
            ];
        }
        return [
            'message' => 'Falha ao tentar autenticar'
        ];
    }

    /**
     * @param array $request
     * @param int $id
     * 
     * @return array
     */
    public function update(array $request = [], int $id) : array
    {
        if ($request && $id) {
            // $model->update($request, $id)
            return array_merge(['id' => $id], $request);
        }

        return [
            'message' => 'Falha ao tentar atualizar'
        ];
    }

    /**
     * @param string $newPassword
     * @param int $id
     * 
     * @return array 
     */
    public function updatePassword(string $newPassword, int $id) : array
    {
        if ($newPassword && $id) {
            return [
                'id' => $id
            ];
        }

        return [
            'message' => 'Falha ao tentar atualizar password'
        ];
    }

    /**
     * @param array $addressData
     * @param int $customerId
     * @param int $addressId
     * 
     * @return array
     */
    public function updateAddress(array $addressData = [], int $customerId, int $addressId) : array 
    {
        if ($addressData) {
            return array_merge(['id' => $customerId], $addressData);
        }

        return [
            'message' => 'Falha ao tentar atualizar o endereço'
        ];
    }

    /**
     * @param array $addressData
     * @param int $customerId
     * 
     * @return array
     */
    public function createAddress(array $addressData = [], int $customerId) : array
    {
        if ($addressData) {
            return array_merge([
                'id' => random_int(0, 100),
                'customer_id' => $customerId
            ], $addressData);
        }

        return [
            'message' => 'Falha ao tentar criar o endereço'
        ];        
    }
}