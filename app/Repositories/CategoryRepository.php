<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository implements ICategoryRepository
{
    public function all(array $filters = []): \Illuminate\Support\Collection
    {
        $query = Category::query();

        if (!empty($filters['parent_category_id'])) {
            $query->where('parent_category_id', $filters['parent_category_id']);
        }

        return $query->get();
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function find(int $id): Category
    {
        return Category::findOrFail($id);
    }

    public function exists(int $id): bool
    {
        return Category::where('id', $id)->exists();
    }

}
