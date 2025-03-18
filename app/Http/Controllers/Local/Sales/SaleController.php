<?php

namespace App\Http\Controllers\Local\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Local\Sales\CreateRequest;
use App\Http\Requests\Local\Sales\UpdateRequest;
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
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->saleRepository->getSales($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        return $this->saleRepository->createSale($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->saleRepository->getSale($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        return $this->saleRepository->updateSale($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->saleRepository->deleteSale($id);
    }

    /**
     * Create Preset Sale
     *
     * @param  string  $type  = liter or kyat ( default kyat )
     */
    public function presetSale(CreateRequest $request, string $type = 'kyat')
    {
        return $this->saleRepository->presetSale($type, $request->validated());
    }

    /**
     * Approve By Casher Sale Request
     */
    public function cashierSale(CreateRequest $request)
    {
        return $this->saleRepository->cashierSale($request->validated());
    }
}
