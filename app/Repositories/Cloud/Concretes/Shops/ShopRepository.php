<?php

namespace App\Repositories\Cloud\Concretes\Shops;

use App\Http\Resources\Cloud\Shops\ShopResource;
use App\Repositories\Cloud\Contracts\Shops\ShopRepositoryInterface;
use App\Traits\HasImage;
use App\Traits\HasResponse;

class ShopRepository implements ShopRepositoryInterface
{
    use HasImage;
    use HasResponse;

    public function getShops($request)
    {
        $shops = Shop::paginate(10);

        return ShopResource::collection($shops);
    }

    public function getShop($id)
    {
        $shop = Shop::find($id);

        if(!$shop) {
            return $this->errorResponse('Shop not found', 404, null);
        }

        return new ShopResource($shop);
    }

    public function createShop($data)
    {
        try {
            // Upload the image if provided
            if(isset($data['image'])) {
                $data['image'] = $this->uploadImage('shops', $data['image']);
            }

            // Create a new shop
            $shop = Shop::create($data);

            if(!$shop) {
                return $this->errorResponse('Failed to create shop', 400, null);
            }

            return new ShopResource($shop);
        } catch(Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function updateShop($id, $data)
    {
        try {
            $shop = Shop::find($id);

            if(!$shop) {
                return $this->errorResponse('Shop not found', 404, null);
            }

            // Upload the image if provided
            if(isset($data['image'])) {
                $data['image'] = $this->uploadImage('shops', $data['image']);
            }

            $shop->update($data);

            return new ShopResource($shop);
        } catch(Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function deleteShop($id)
    {
        $shop = Shop::find($id);

        if(!$shop) {
            return $this->errorResponse('Shop not found', 404, null);
        }

        if($shop->image) {
            $this->deleteImage($shop->image);
        }

        $shop->delete();

        return $this->successResponse('Shop deleted successfully', 200, null);
    }
}
