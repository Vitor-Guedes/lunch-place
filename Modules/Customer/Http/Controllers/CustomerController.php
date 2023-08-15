<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class CustomerController
extends Controller
{
    /**
     * Register new customer to application
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // substitui por $request->validated()
        $customerData = $request->all();

        // implementar logica de registro do customer
        if ($customerData) {
            return response()->json([], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json([], Response::HTTP_OK);
    }

    /**
     * Authenticate passed credentials, if ok create a session, otherwise warn about invalid credentials
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        $creadentials = $request->only(['email', 'password']);

        // implementar logica de autenticação - buscando dados no banco
        if ($creadentials) {
            return response([], Response::HTTP_UNAUTHORIZED);
        }
        
        return response()->json([], Response::HTTP_OK);
    }

    /**
     * Update customer data, cuurently logged
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        // substitui por $request->validated()
        $customerData = $request->all();

        // fail validade response de dados que não pode ser processado
        if ($customerData) {
            return response([], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        return response()->json([], Response::HTTP_OK);
    }

    /**
     * Change customer password, cuurently logged
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function chagePassword(Request $request)
    {
        // substitui por $request->validated()
        $chagePassword = $request->all();

        // fail validade response de dados que não pode ser processado
        if ($chagePassword) {
            return response([], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        return response()->json([], Response::HTTP_OK);
    }

    /**
     * Closes the current customer session
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        return response()->json([], Response::HTTP_OK);
    }
}