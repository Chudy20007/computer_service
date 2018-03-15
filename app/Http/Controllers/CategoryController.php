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
    {   $categories = Category::where('active','=',true)->where('id','=',$id)->get();
        return view('categories.edit_category')->with('categories',$categories);;
    }

    public function editCategory (CategoryRequest $request)
    {
        $data = $request->all();
        Category::where('id',$data['id'])->update([
          'name' => $data['name']  
        ]);
        return ("Success!");
    }
    public function showCategoryForm ()
    {  
        return view('categories.create_category');
    }

    public function storeCategory (CategoryRequest $request)
    {
 
        Category::create($request->toArray());
        return ("Success!");
    }

    public function showCategoriesList()
    {
        $categories = Category::where('active','=',true)->get();

        return view ('categories.categories_list')->with('categories',$categories);
    }

}
