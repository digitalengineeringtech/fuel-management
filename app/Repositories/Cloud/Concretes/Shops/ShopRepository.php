<?php

namespace App\Repositories\Cloud\Concretes\Shops;

use App\Http\Resources\Cloud\Shops\ShopResource;
use App\Models\Shop;
use App\Repositories\Cloud\Contracts\Shops\ShopRepositoryInterface;
use App\Traits\HasGenerate;
use App\Traits\HasImage;
use App\Traits\HasResponse;

class ShopRepository implements ShopRepositoryInterface
{
    use HasGenerate;
    use HasImage;
    use HasResponse;

    public function getShops($request)
    {
        try {
            $shops = Shop::paginate(10);

            if (! $shops) {
                return $this->errorResponse('Shops not found', 404, null);
            }

            return ShopResource::collection($shops);
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
            // Create a new shop
            $shop = Shop::create([
                'name' => $data['name'],
                'code' => $this->generateShopNumber($data['name']),
                'image' => isset($data['image']) ?? $this->uploadImage('shops', $data['image']),
                'address' => $data['address'],
                'importer_name' => $data['importer_name'],
                'importer_company' => $data['importer_company'],
            ]);

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

            $shop->update([
                'name' => $data['name'],
                'code' => $this->generateShopNumber($data['name']),
                'image' => isset($data['image']) ?? $this->uploadImage('shops', $data['image']),
                'address' => $data['address'],
                'importer_name' => $data['importer_name'],
                'importer_company' => $data['importer_company'],
            ]);

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
