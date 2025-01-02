<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create {name} {description} {price} {category_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating a new product in the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $description = $this->argument('description');
        $price = $this->argument('price');
        $categoryId = $this->argument('category_id');

        $product = Product::create([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_id' => $categoryId,
        ]);

        $this->info("Product: '{$product->name}' created successfully!");
    }
}
