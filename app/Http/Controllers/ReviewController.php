<?php

namespace App\Http\Controllers;

use App\Services\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    protected ReviewService $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function index(Request $request)
    {   
        $productId = $request->query('product_id');
        $perPage = $request->query('per_page', 12);

        $reviews = $this->reviewService->getAllReviews($productId, $perPage);

        return response()->json($reviews);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'comment' => 'required|string|max:1000',
            'rating' => 'required|numeric|between:1,5'
        ]);

        $data['user_id'] = auth()->id();

        return response()->json($this->reviewService->create($data), 201);
    }

    public function byProduct($id)
    {
        return response()->json($this->reviewService->getByProduct($id));
    }
    public function byOwner()
    {
        $userId = Auth::id();
        return response()->json($this->reviewService->getByUser($userId));
    }
    public function updateReview(Request $request, int $id)
    {
        $userId = auth()->id();

        $data = $request->validate([
            'comment' => 'required|string',
        ]);

        try {
            $review = $this->reviewService->updateReview($id, $userId, $data);
            return response()->json($review);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }

    public function destroyReview(int $id)
    {
        $userId = auth()->id();

        try {
            $this->reviewService->deleteReview($id, $userId);
            return response()->json(['message' => 'Review deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }
}
