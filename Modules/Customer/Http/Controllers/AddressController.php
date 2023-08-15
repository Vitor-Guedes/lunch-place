<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class AddressController
extends Controller
{
    /**
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $customerAddressData = $request->all();
        
        if ($customerAddressData) {
            return response()->json([], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response([], Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $customerAddressData = $request->all();
        
        if ($customerAddressData) {
            return response()->json([], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response([], Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        return response([], Response::HTTP_OK);
    }
}