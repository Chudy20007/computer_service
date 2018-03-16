<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $category = new Category();
        $category->name = "touchpads";
        $category->active=false;
        $category->save();
        $category=null;
        $category2 = new Category();
        $category2->name = "keyboards";
        $category2->active=true;
        $category2->save();
        $category3=null;
        $category3 = new Category();
        $category3->name = "coolers";
        $category3->active=true;
        $category3->save();
        }
    
}
