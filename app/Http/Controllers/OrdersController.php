<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrdersRequest;
use App\Http\Services\OrdersService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    protected $ordersService;

    public function __construct(OrdersService $ordersService)
    {
        $this->ordersService = $ordersService;
    }

    public function index(OrdersRequest $request){
        try{
            $validated = $request->validated();
            Log::info('Validated data:', $validated);
            $objectData = json_decode(json_encode($validated), false);

            $processedData = $this->ordersService->processOrderData($objectData);

            return response()->json([
                'success' => true,
                'data' => $processedData
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'succes' => false,
                'message' => $e
            ], 500);
        }
        
    }
}
