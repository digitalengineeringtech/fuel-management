<?php

namespace App\Http\Controllers\Cloud\Shops;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cloud\Shops\CreateRequest;
use App\Http\Requests\Cloud\Shops\UpdateRequest;
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
     * All Shops
     *
     * @response array{message: string, code: int, data: ShopResource[]}
     */
    public function index(Request $request)
    {
        return $this->shopRepository->getShops($request);
    }

    /**
     * Create Shop
     *
     * @response array{message: string, code: int, data: ShopResource}
     */
    public function store(CreateRequest $request)
    {
        return $this->shopRepository->createShop($request->validated());
    }

    /**
     * Single Shop
     *
     * @response array{message: string, code: int, data: ShopResource}
     */
    public function show(string $id)
    {
        return $this->shopRepository->getShop($id);
    }

    /**
     * Update Shop
     *
     * @response array{message: string, code: int, data: ShopResource}
     */
    public function update(UpdateRequest $request, string $id)
    {
        return $this->shopRepository->updateShop($id, $request->validated());
    }

    /**
     * Delete Shop
     *
     * @response array{message: string, code: int, data: null}
     */
    public function destroy(string $id)
    {
        return $this->shopRepository->deleteShop($id);
    }
}
