<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class CategoryTest extends TestCase
{
    protected $categoryRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->categoryRepository = new CategoryRepository(new Category());
    }

    public function test_creating_product()
    {
        $data = [
            'name' => 'Category Test',
            'parent_category_id' => null,
        ];

        $product = $this->categoryRepository->create($data);

        $this->assertDatabaseHas('categories', $data);
    }
}
