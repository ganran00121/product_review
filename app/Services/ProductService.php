<?php

namespace App\Services;

use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Validation\ValidationException;

class ProductService
{
    protected ProductRepositoryInterface $productRepositoryInterface;

    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    public function getAllProducts()
    {
        return $this->productRepositoryInterface->getAll();
    }
    public function getProductsPaginated(int $perPage = 12)
    {
        return $this->productRepositoryInterface->paginate($perPage);
    }
    public function getProductById(int $id)
    {
        $product = $this->productRepositoryInterface->find($id);
        if (!$product) {
            throw ValidationException::withMessages([
                'id' => ["Product with id {$id} not found"]
            ]);
        }
        return $product;
    }


    public function createProduct(array $data)
    {
        if ($data['price'] < 0) {
            throw ValidationException::withMessages([
                'price' => ['ราคาต้องเป็นจำนวนบวกเท่านั้น']
            ]);
        }
        return $this->productRepositoryInterface->create($data);
    }
}
