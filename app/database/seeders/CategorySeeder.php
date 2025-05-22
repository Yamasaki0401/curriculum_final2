<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = ['料理', '掃除', '裁縫', '制作', 'ガーデニング'];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
