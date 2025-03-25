<?php

namespace App\Http\Controllers\Cloud\Discounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cloud\Discounts\CreateRequest;
use App\Http\Requests\Cloud\Discounts\UpdateRequest;
use App\Http\Resources\Cloud\Discounts\DiscountResource;
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
     * All Discounts
     *
     * @response array{message: string, code: int, data: DiscountResource[]}
     */
    public function index(Request $request)
    {
        return $this->discountRepository->getDiscounts($request);
    }

    /**
     * Create Discount
     *
     * @response array{message: string, code: int, data: DiscountResource}
     */
    public function store(CreateRequest $request)
    {
        return $this->discountRepository->createDiscount($request->validated());
    }

    /**
     * Single Discount
     *
     * @response array{message: string, code: int, data: DiscountResource}
     */
    public function show($id)
    {
        return $this->discountRepository->getDiscount($id);
    }

    /**
     * Update Discount
     *
     * @response array{message: string, code: int, data: DiscountResource}
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->discountRepository->updateDiscount($id, $request->validated());
    }

    /**
     * Delete Discount
     *
     * @response array{message: string, code: int, data: null}
     */
    public function destroy($id)
    {
        return $this->discountRepository->deleteDiscount($id);
    }
}
