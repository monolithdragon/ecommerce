<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    protected $categories = [
        [
            'name' => 'Fashion & Accessories',
            'slug' => ''
        ],
        [
            'name' => 'Furnitures & Home Decors',
            'slug' => ''
        ],
        [
            'name' => 'Digital & Electronics',
            'slug' => ''
        ],
        [
            'name' => 'Tools & Equipments',
            'slug' => ''
        ],
        [
            'name' => 'Kid’s Toys',
            'slug' => ''
        ],
        [
            'name' => 'Organics & Spa',
            'slug' => ''
        ],
    ];

    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $category) {
            $category['slug'] = Str::slug($category['name']);

            Category::create($category);
        }
    }
}
