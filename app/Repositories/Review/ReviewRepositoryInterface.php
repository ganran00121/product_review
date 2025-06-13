<?php

namespace App\Repositories\Review;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ReviewRepositoryInterface
{
    public function find(int $id): Review;
    public function getByProductId(int $productId): ?Product;
    public function getByUserId(int $userId): Collection;
    public function create(array $data): Review;
}
