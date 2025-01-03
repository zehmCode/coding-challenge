<?php

namespace App\Http\Controllers;

use App\Repositories\ICategoryRepository;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected ICategoryRepository $categoryRepository;
    protected CategoryService $categoryService;

    public function __construct(ICategoryRepository $categoryRepository,CategoryService $categoryService)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request): JsonResponse
    {
        $categories = $this->categoryRepository->all($request->only('parent_category_id'));
        return response()->json($categories);
    }

    public function create(Request $request): JsonResponse
    {
        $data = $this->categoryService->validateAndPrepareData($request->all());

        $category = $this->categoryRepository->create($data);

        return response()->json($category, 201);
    }
}
