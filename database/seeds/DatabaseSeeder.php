<?php

use App\ProductCategory;
use App\ProductType;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create administrator account on the local server
        if (app()->environment('local'))
        {
            $admin = new User([
                'username' => 'admin',
                'password' => bcrypt('admin'),
            ]);

            $admin->save();
        }

        // Create a new category with temporary slug
        $category = new ProductCategory(['name' => 'Ostatní', 'slug' => Str::random()]);
        $category->save();
        $category->generateSlug();

        // Create a new type with temporary slug
        $type = new ProductType(['name' => 'Ostatní', 'slug' => Str::random(), 'category_id' => $category->id]);
        $type->save();
        $type->generateSlug();
    }
}
