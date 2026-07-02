<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Technology']);
        Category::create(['name' => 'Laravel']);
        Category::create(['name' => 'PHP']);

        Tag::create(['name' => 'Backend']);
        Tag::create(['name' => 'Tips']);
        Tag::create(['name' => 'Tutorial']);
    }
}