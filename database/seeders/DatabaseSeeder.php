<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CreationSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(CategorySeeder::class);
        \App\Models\Like::factory(2)->create();
    }
}
