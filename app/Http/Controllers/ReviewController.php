<?php

namespace App\Http\Controllers;

use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected ReviewService $service;

    public function __construct(ReviewService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'comment'    => 'required|string|max:1000',
            'rating'     => 'required|numeric|between:1,5'
        ]);

        $data['user_id'] = auth()->id();

        return response()->json($this->service->create($data), 201);
    }

    public function byProduct($id)
    {
        return response()->json($this->service->getByProduct($id));
    }
}
