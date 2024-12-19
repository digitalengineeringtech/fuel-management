<?php

namespace App\Http\Controllers\Cloud\Shops;

use App\Http\Controllers\Controller;
use App\Repositories\Cloud\Contracts\Shops\ShopRepositoryInterface;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private ShopRepositoryInterface $shopRepository;

    public function __construct(ShopRepositoryInterface $shopRepository)
    {
        $this->shopRepository = $shopRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->shopRepository->getShops($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->shopRepository->createShop($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->shopRepository->getShop($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->shopRepository->updateShop($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->shopRepository->deleteShop($id);
    }
}
