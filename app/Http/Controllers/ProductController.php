<?php

namespace App\Http\Controllers;

use App\Repositories\IProductRepository;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected IProductRepository $productRepository;
    protected ProductService $productService;

    public function __construct(IProductRepository $productRepository, ProductService $productService)
    {
        $this->productRepository = $productRepository;
        $this->productService = $productService;
    }

    public function index(Request $request): JsonResponse
    {
        $sortBy = $request->query('sortBy', 'asc');
        $filters = $request->only('category_id');

        $products = $this->productRepository->all($sortBy, $filters);

        return response()->json($products, 200);
    }

    public function create(Request $request): JsonResponse
    {
        $data = $this->productService->validateAndPrepareData($request->all(), $request->file('image'));

        $product = $this->productRepository->create($data);

        return response()->json($product, 201);
    }
}
