<?php

namespace App\Http\Controllers;

use App\Repositories\IProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(Request $request)
    {
        $sortBy = $request->query('sortBy', 'asc');
        $filters = $request->only('category_id');

        $products = $this->productRepository->all($sortBy, $filters);

        return response()->json($products, 200);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $product = $this->productRepository->create($data);

        return response()->json($product, 201);
    }
}
