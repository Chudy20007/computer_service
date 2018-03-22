<?php

namespace App\Http\Controllers;
use App\Http\Requests\CategoryRequest;
use App\Category;
use Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permissions',['except' => ['showCategoriesList']]);
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

        switch (Auth::user()->getRole())
        {
            case "employee":
            {
                $categories = Category::where('active','=',true)->get();

                return view ('categories.categories_list_e')->with('categories',$categories);                 
            }

            case "supervisor":
            {
                $categories = Category::where('active','=',true)->get();

                return view ('categories.categories_list_s')->with('categories',$categories);               
            }

            case "admin":
            {
                $categories = Category::all();

                return view ('categories.categories_list_a')->with('categories',$categories);               
            }

            default:
            {
        return view('pictures.access_denied');
                 
            }

        }


    }

}
