<?php

namespace App\Http\Controllers\Cloud\Discounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cloud\Discounts\CreateRequest;
use App\Http\Requests\Cloud\Discounts\UpdateRequest;
use App\Repositories\Cloud\Contracts\Discounts\DiscountRepositoryInterface;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    private $discountRepository;

    public function __construct(DiscountRepositoryInterface $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->discountRepository->getDiscounts($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        return $this->discountRepository->createDiscount($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->discountRepository->getDiscount($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->discountRepository->updateDiscount($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->discountRepository->deleteDiscount($id);
    }
}
