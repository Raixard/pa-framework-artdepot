<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id' => '1',
                'category_name' => 'Digital Art'
            ],
            [
                'id' => '2',
                'category_name' => 'Photography'
            ],
            [
                'id' => '3',
                'category_name' => 'Traditional Art'
            ],
            [
                'id' => '4',
                'category_name' => 'Pixel Art'
            ],
            [
                'id' => '5',
                'category_name' => '3D'
            ],
            [
                'id' => '6',
                'category_name' => 'Anthro'
            ],
        ];

        foreach ($categories as $categ) {
            Category::create([
                'id' => $categ['id'],
                'category_name' => $categ['category_name'],
            ]);
        }
    }
}
