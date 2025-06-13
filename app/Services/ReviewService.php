<?php

namespace App\Services;

use App\Repositories\Review\ReviewRepositoryInterface;

class ReviewService
{
    protected ReviewRepositoryInterface $ReviewRepositoryInterface;

    public function __construct(ReviewRepositoryInterface $ReviewRepositoryInterface)
    {
        $this->ReviewRepositoryInterface = $ReviewRepositoryInterface;
    }

    public function getAllReviews(?int $productId, int $perPage = 12)
    {
        return $this->ReviewRepositoryInterface->getAll($productId, $perPage);
    }
    public function getByProduct(int $productId)
    {
        return $this->ReviewRepositoryInterface->getByProductId($productId);
    }

    public function getByUser(int $userId)
    {
        return $this->ReviewRepositoryInterface->getByUserId($userId);
    }

    public function create(array $data)
    {
        return $this->ReviewRepositoryInterface->create($data);
    }

    public function updateReview(int $id, int $userId, array $data)
    {
        $review = $this->ReviewRepositoryInterface->find($id);

        if (!$review) {
            throw new \Exception('Review not found');
        }

        if ($review->user_id !== $userId) {
            throw new \Exception('Unauthorized');
        }

        return $this->ReviewRepositoryInterface->update($id, $data);
    }
    public function deleteReview(int $id, int $userId): bool
    {
        $review = $this->ReviewRepositoryInterface->find($id);

        if (!$review) {
            throw new \Exception('Review not found');
        }

        if ($review->user_id !== $userId) {
            throw new \Exception('Unauthorized');
        }

        return $this->ReviewRepositoryInterface->delete($id);
    }

}
