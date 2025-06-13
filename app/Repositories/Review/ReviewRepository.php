<?php

namespace App\Repositories\Review;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ReviewRepository implements ReviewRepositoryInterface
{
    public function find(int $id): Review
    {
        return Review::findOrFail($id);
    }

    public function getByProductId(int $productId): ?Product
    {
        return Product::with(['reviews.user' ])
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
}
