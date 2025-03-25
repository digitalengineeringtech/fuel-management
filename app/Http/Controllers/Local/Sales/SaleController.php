<?php

namespace App\Http\Controllers\Local\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Local\Sales\CreateRequest;
use App\Http\Requests\Local\Sales\UpdateRequest;
use App\Http\Resources\Local\Sales\SaleResource;
use App\Repositories\Local\Contracts\Sales\SaleRepositoryInterface;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public SaleRepositoryInterface $saleRepository;

    public function __construct(SaleRepositoryInterface $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }

    /**
     * All Sales
     *
     * @response array{message: string, code: int, data: SaleResource[]}
     */
    public function index(Request $request)
    {
        return $this->saleRepository->getSales($request);
    }

    /**
     * Create Sale
     *
     * @response array{message: string, code: int, data: SaleResource}
     */
    public function store(CreateRequest $request)
    {
        return $this->saleRepository->createSale($request->validated());
    }

    /**
     * Single Sale
     *
     * @response array{message: string, code: int, data: SaleResource}
     */
    public function show(string $id)
    {
        return $this->saleRepository->getSale($id);
    }

    /**
     * Update Sale
     *
     * @response array{message: string, code: int, data: SaleResource}
     */
    public function update(UpdateRequest $request, string $id)
    {
        return $this->saleRepository->updateSale($id, $request->validated());
    }

    /**
     * Delete Sale
     *
     * @response array{message: string, code: int, data: null}
     */
    public function destroy(string $id)
    {
        return $this->saleRepository->deleteSale($id);
    }

    /**
     * Create Preset Sale
     *
     * @param  string  $type  = liter or kyat (default kyat)
     *
     * @response array{message: string, code: int, data: SaleResource}
     */
    public function presetSale(CreateRequest $request, string $type = 'kyat')
    {
        return $this->saleRepository->presetSale($type, $request->validated());
    }

    /**
     * Approve By Cashier Sale Request
     *
     * @response array{message: string, code: int, data: SaleResource}
     */
    public function cashierSale(CreateRequest $request)
    {
        return $this->saleRepository->cashierSale($request->validated());
    }
}
