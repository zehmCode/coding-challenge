<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository implements ICategoryRepository
{
    public function all($filters = [])
    {
        $query = Category::query();

        if (!empty($filters['parent_category_id'])) {
            $query->where('parent_category_id', $filters['parent_category_id']);
        }

        return $query->get();
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function find($id)
    {
        return Category::findOrFail($id);
    }

}
