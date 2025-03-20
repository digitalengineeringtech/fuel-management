<?php

namespace App\Repositories\Cloud\Concretes\Shops;

use App\Http\Resources\Cloud\Shops\ShopResource;
use App\Models\Shop;
use App\Repositories\Cloud\Contracts\Shops\ShopRepositoryInterface;
use App\Traits\HasImage;
use App\Traits\HasResponse;

class ShopRepository implements ShopRepositoryInterface
{
    use HasImage;
    use HasResponse;

    public function getShops($request)
    {
        try {
            $shops = Shop::paginate(10);

            if (! $shops) {
                return $this->errorResponse('Shops not found', 404, null);
            }

            return $this->successResponse('Shops successfully retrieved', 200, ShopResource::collection($shops));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function getShop($id)
    {
        try {
            $shop = Shop::find($id);

            if (! $shop) {
                return $this->errorResponse('Shop not found', 404, null);
            }

            return $this->successResponse('Shop successfully retrieved', 200, new ShopResource($shop));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function createShop($data)
    {
        try {
            // Upload the image if provided
            if (isset($data['image'])) {
                $data['image'] = $this->uploadImage('shops', $data['image']);
            }

            // Create a new shop
            $shop = Shop::create($data);

            if (! $shop) {
                return $this->errorResponse('Failed to create shop', 400, null);
            }

            return $this->successResponse('Shop successfully created', 201, new ShopResource($shop));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function updateShop($id, $data)
    {
        try {
            $shop = Shop::find($id);

            if (! $shop) {
                return $this->errorResponse('Shop not found', 404, null);
            }

            // Upload the image if provided
            if (isset($data['image'])) {
                $data['image'] = $this->uploadImage('shops', $data['image']);
            }

            $shop->update($data);

            return $this->successResponse('Shop successfully updated', 200, new ShopResource($shop));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function deleteShop($id)
    {
        try {
            $shop = Shop::find($id);

            if (! $shop) {
                return $this->errorResponse('Shop not found', 404, null);
            }

            if ($shop->image) {
                $this->deleteImage($shop->image);
            }

            $shop->delete();

            return $this->successResponse('Shop deleted successfully', 200, null);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
