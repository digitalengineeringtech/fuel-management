<?php

namespace App\Http\Controllers\Cloud\Payments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cloud\Payments\CreateRequest;
use App\Http\Requests\Cloud\Payments\UpdateRequest;
use App\Repositories\Cloud\Contracts\Payments\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->paymentRepository->getPayments($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        return $this->paymentRepository->createPayment($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->paymentRepository->getPayment($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->paymentRepository->updatePayment($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->paymentRepository->deletePayment($id);
    }
}
