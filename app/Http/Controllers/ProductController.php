<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;


class ProductController extends Controller
{
    protected ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {   
        $perPage = (int) $request->query('per_page', 12);
        $paginated = $this->service->getProductsPaginated($perPage);
        return response()->json($paginated);
    }
    public function show($id)
    {
        $product = $this->service->getProductById((int)$id);
        return response()->json($product);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
        ]);

        $product = $this->service->createProduct($data);

        return response()->json($product, 201);
    }
    
}
