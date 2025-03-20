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
     * All Payments
     *
     * @response array{message: string, code: int, data: PaymentResource[]}
     */
    public function index(Request $request)
    {
        return $this->paymentRepository->getPayments($request);
    }

    /**
     * Create Payment
     *
     * @response array{message: string, code: int, data: PaymentResource}
     */
    public function store(CreateRequest $request)
    {
        return $this->paymentRepository->createPayment($request->validated());
    }

    /**
     * Single Payment
     *
     * @response array{message: string, code: int, data: PaymentResource}
     */
    public function show($id)
    {
        return $this->paymentRepository->getPayment($id);
    }

    /**
     * Update Payment
     *
     * @response array{message: string, code: int, data: PaymentResource}
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->paymentRepository->updatePayment($id, $request->validated());
    }

    /**
     * Delete Payment
     *
     * @response array{message: string, code: int, data: null}
     */
    public function destroy($id)
    {
        return $this->paymentRepository->deletePayment($id);
    }
}
