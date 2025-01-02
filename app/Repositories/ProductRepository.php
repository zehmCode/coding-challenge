<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements IProductRepository
{
    public function all($sortBy = null, $filters = [])
    {
        $query = Product::query();

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if ($sortBy) {
            $query->orderBy('price', $sortBy);
        }

        return $query->get();
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function find($id)
    {
        return Product::findOrFail($id);
    }
}