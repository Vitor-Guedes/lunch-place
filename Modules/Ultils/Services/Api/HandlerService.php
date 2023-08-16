<?php

namespace Modules\Ultils\Services\Api;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;

class HandlerService
{
    protected $resolve;

    /**
     * @param array|FormRequest
     */
    public function handler(string $method, ...$request)
    {
        $resolve = null;

        $this->before();
        
        if (is_array($request)) {
            $resolve = call_user_func_array([$this, $method], $request);
        }

        // melhorar
        if ($this->hasFormRequestInstance($request)) {
            $requestParserd = [];
            foreach ($request as $paramater => $value) {
                if ($paramater instanceof FormRequest) {
                    $requestParserd[$paramater] = $value->validated();
                }
            }
            $resolve = call_user_func_array([$this, $method], $requestParserd);
        }

        $this->resolve = $resolve;

        $this->after();

        return $resolve;
    }

    private function hasFormRequestInstance($request)
    {
        $filter = array_filter($request, function ($paramater) {
            return $paramater instanceof FormRequest;
        });
        return count($filter) > 0;
    }

    protected function before()
    {

    }

    protected function after()
    {

    }
}