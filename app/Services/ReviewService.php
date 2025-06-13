<?php

namespace App\Services;

use App\Repositories\Review\ReviewRepositoryInterface;

class ReviewService
{
    protected ReviewRepositoryInterface $RepositoryInterface;

    public function __construct(ReviewRepositoryInterface $RepositoryInterface)
    {
        $this->RepositoryInterface = $RepositoryInterface;
    }


    public function getByProduct(int $productId)
    {
        return $this->RepositoryInterface->getByProductId($productId);
    }

    public function getByUser(int $userId)
    {
        return $this->RepositoryInterface->getByUserId($userId);
    }

    public function create(array $data)
    {
        return $this->RepositoryInterface->create($data);
    }
}
