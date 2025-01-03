<?php

namespace App\Services;

use App\Repositories\ICategoryRepository;
use Illuminate\Support\Facades\Validator;

class CategoryService
{
    protected ICategoryRepository $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    private function categoryExists ($attribute, $value, $fail): void
    {
        if (!$this->categoryRepository->exists($value)) {
            $fail('The selected category is invalid.');
        }
    }

    public function validateAndPrepareData(array $data): array
    {
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'parent_category_id' => ['nullable', 'integer', [$this, 'categoruExists']],
        ]);
        
        $validator->validate();

        return $data;
    }

}