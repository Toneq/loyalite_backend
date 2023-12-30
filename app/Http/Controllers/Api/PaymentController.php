<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function create_payment(Request $request){
        return $this->paymentService->createPayment($request);
    }
}
