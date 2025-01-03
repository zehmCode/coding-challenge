<?php

namespace App\Services;

use App\Repositories\ICategoryRepository;
use Illuminate\Support\Facades\Validator;

class ProductService
{
    protected ICategoryRepository $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    // private function categoryExists ($attribute, $value, $fail): void
    // {
    //     if (!$this->categoryRepository->exists((int) $value)) {
    //         $fail('The selected category is invalid.');
    //     }
    // }

    public function validateAndPrepareData(array $data, $image = null): array
    {
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => [
                'nullable',
                'integer',
                function ($attribute, $value, $fail) {
                    if ($value !== null && !$this->categoryRepository->exists((int) $value)) {
                        $fail('The selected category is invalid.');
                    }
                }
            ],
        ]);

        $validator->validate();

        if ($image) {
            $data['image'] = $image->store('images', 'public');
        }

        return $data;
    }

}