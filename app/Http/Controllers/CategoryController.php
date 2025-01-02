<?php

namespace App\Http\Controllers;

use App\Repositories\ICategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryRepository->all($request->only('parent_category_id'));
        return response()->json($categories);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'parent_category_id' => 'nullable|exists:categories,id',
        ]);

        $category = $this->categoryRepository->create($data);

        return response()->json($category, 201);
    }
}
