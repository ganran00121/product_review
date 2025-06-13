<?php

namespace App\Repositories\Review;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ReviewRepository implements ReviewRepositoryInterface
{
    public function getAll(int $productId = null, int $perPage = 12)
    {
        $query = Review::with(['user', 'product']);

        if ($productId !== null) {
            $query->where('product_id', $productId);
        }

        $query->orderBy('created_at', 'desc');

        return $query->paginate($perPage);
    }
    public function find(int $id): Review
    {
        return Review::findOrFail($id);
    }

    public function getByProductId(int $productId): ?Product
    {
        return Product::with(['reviews.user'])
            ->withAvg('reviews as average_rating', 'rating')
            ->find($productId);
    }

    public function getByUserId(int $userId): Collection
    {
        return Review::where('user_id', $userId)->get();
    }

    public function create(array $data): Review
    {
        return Review::create($data);
    }
    public function update(int $id, array $data)
    {
        $review = Review::findOrFail($id);
        $review->update($data);
        return $review;
    }
    public function delete(int $id): bool
    {
        $review = Review::findOrFail($id);
        return $review->delete();
    }
}
