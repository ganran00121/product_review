<?php

namespace App\Repositories\Product;

use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll()
    {
        return Product::all();
    }
    public function paginate(int $perPage = 12)
    {
        $products = Product::with(['reviews', 'reviews.user'])
            ->withAvg('reviews as average_rating', 'rating')
            ->orderBy('id', 'desc')
            ->paginate(request('per_page', 12));
        return response()->json($products);
    }
    public function update(int $id, array $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }
    public function find(int $id): ?Product
    {
        return Product::with(['reviews', 'reviews.user'])
            ->withAvg('reviews as average_rating', 'rating')
            ->find($id);
    }
    public function create(array $data): Product
    {
        return Product::create($data);
    }
    public function delete(int $id)
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }
}
