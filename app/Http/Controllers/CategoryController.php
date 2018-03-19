<?php

namespace App\Http\Controllers;
use App\Http\Requests\CategoryRequest;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permissions');
    }



    public function showCategoryEditForm ($id)
    {   $category = Category::where('active','=',true)->where('id','=',$id)->get()->first();
        return view('categories.edit_category')->with('category',$category);
    }

    public function editCategory (CategoryRequest $request)
    {
        $data = $request->all();
        Category::where('id',$data['id'])->update([
          'name' => $data['name']  
        ]);
        return redirect ('show_categories');
    }
    public function showCategoryForm ()
    {  
        return view('categories.create_category');
    }

    public function storeCategory (CategoryRequest $request)
    {
 
        Category::create($request->toArray());
        return ("show_categories");
    }

    public function showCategoriesList()
    {
        $categories = Category::where('active','=',true)->get();

        return view ('categories.categories_list')->with('categories',$categories);
    }

}
