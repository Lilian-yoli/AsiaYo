<?php

namespace App\Http\Services;

use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Validation\ValidationException;

class OrdersService
{
    protected $validator;

    public function __construct(ValidationFactory $validator)
    {
        $this->validator = $validator;    
    }

    public function processOrderData(object $data)
    {
        try {
            $this->checkData($data);
            $transformedData = $this->transformData($data);

            return $transformedData;
        } catch (ValidationException $e){
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 400);
        }
        
    }

    protected function checkData(object $data)
    {
        $this->checkName($data);
        $this->checkPrice($data);
        $this->checkCurrency($data);
    }

    public function checkName(object $data)
    {
        $rule = [
            'name' => [
                'required',
                'string',
                'regex:/^[A-Z][a-z]*(\s[A-Z][a-z]*)*$/',
                'regex:/^[a-zA-Z\s]*$/'
            ]
        ];

        $message = [
            'name.regex' => 'Name is not capitalized or contains non-English characters'
        ];

        $this->validator->make((array) $data, $rule, $message)->validate();

        return $data;
    }

    public function checkPrice(object $data)
    {
        $rule = [
            'price' => 'required|numeric|max:2000',
        ];

        $message = [
            'price.max' => 'Price is over 2000',
        ];

        $this->validator->make((array) $data, $rule, $message)->validate();

        return $data;
    }

    public function checkCurrency(object $data)
    {
        $rule = [
            'currency' => 'required|string|in:TWD,USD',
        ];

        $message = [
            'currency.in' => 'Currency format is wrong',
        ];

        $this->validator->make((array) $data, $rule, $message)->validate();
        
        return $data;
    }

    public function transformData(object $data)
    {
        if($data->currency === 'USD'){
            $data->price = $data->price * 31;
            $data->currency = 'TWD';
        }
        return $data;
    }
}