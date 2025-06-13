<?php

namespace App\Repositories\Review;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ReviewRepositoryInterface
{   
    public function getAll(int $productId = null, int $perPage = 12);
    public function find(int $id): Review;
    public function getByProductId(int $productId): ?Product;
    public function getByUserId(int $userId): Collection;
    public function create(array $data): Review;
    public function update(int $id, array $data);
    public function delete(int $id): bool;

}
