<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Vegetarian',
            'slug' => "vegetarian"
        ]);

        Category::create([
            'name' => 'Vegan',
            'slug' => "vegan"
        ]);

        Category::create([
            'name' => 'Sup',
            'slug' => "sup"
        ]);

        Category::create([
            'name' => 'Daging',
            'slug' => "daging"
        ]);
    }
}
