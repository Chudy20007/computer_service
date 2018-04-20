<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Auth;
use Session;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permissions', ['except' => ['showCategoriesList', 'findCategories','sortCategories']]);
    }

    public function showCategoryEditForm($id)
    {$category = Category::where('active', '=', true)->where('id', '=', $id)->get()->first();
        return view('categories.edit_category')->with('category', $category);
    }

    public function editCategory(CategoryRequest $request)
    {
        $data = $request->all();
        Category::where('id', $data['id'])->update([
            'name' => $data['name'],
        ]);
        Session::put('message', 'Kategoria została pomyślnie zaktualizowana!');
        return redirect('show_categories');
    }
    public function showCategoryForm()
    {
        return view('categories.create_category');
    }

    public function sortCategories()
    {
        $data = json_decode(file_get_contents('php://input'), true); 
        $data['column_name'] = htmlentities($data['column_name']);
        $data['column_name'] = stripslashes($data['column_name']);
        $data['table_name'] = htmlentities($data['table_name']);
        $data['table_name'] = stripslashes($data['table_name']);
        $data['data_sort'] = htmlentities($data['data_sort']);
        $data['data_sort'] = stripslashes($data['data_sort']);

       
        switch(Auth::user()->getRole())
        {
            case 'admin':
            {
                $categories = Category::orderBy($data['column_name'],$data['data_sort'])->get();
                $content=$this->getSearchingResultsAdmin($categories);
                break;
            }
            case 'employee':
            {
                $categories = Category::where('active',true)->orderBy($data['column_name'],$data['data_sort'])->get();
                $content=$this->getSearchingResultsEmployee($categories);
                break;
            }
            case 'supervisor':
            {
                $categories = Category::orderBy($data['column_name'],$data['data_sort'])->get();
                $content=$this->getSearchingResultsSupervisor($categories);
                break;
            }

            default:
            {
                return;
            }
        }


        return json_encode($content);
    }
    public function getSearchingResultsEmployee($categories)
    {
        $content = "";
        foreach ($categories as $category) {
            $content .= ("<tr class='table-light'>
            <td>$category->name</td>
          </tr>");

        }

        return ($content);
    }
    public function getSearchingResultsSupervisor($categories)
    {
        $content = "";
        foreach ($categories as $category) {
            $content .= ("<tr class='table-light'>
            <td>$category->name</td>
            <td> $category->created_at</td>
            <td> $category->updated_at</td>
            <td> <form method='GET' action='http://localhost/computer_service/public/edit_category/$category->id' 
                accept-charset='UTF-8' class='form-horizontal'> 
                <input class='form-control' name='id' type='hidden' value='$category->id'>
                 <input class='btn btn-primary' type='submit' value=Edytuj> </form> </a>
              </td>
          </tr>");

        }

        return ($content);
    }

    public function getSearchingResultsAdmin($categories)
    {
        $content = "";
        foreach ($categories as $category) {
            $content .= ("<tr class='table-light'>
            <td>$category->name</td>
            <td> $category->created_at</td>
            <td> $category->updated_at</td>
            <td>".($category->active==1 ?'tak':'nie')."</td>
            <td> <form method='GET' action='http://localhost/computer_service/public/edit_category/$category->id' 
                accept-charset='UTF-8' class='form-horizontal'> 
                <input class='form-control' name='id' type='hidden' value='$category->id'>
                 <input class='btn btn-primary' type='submit' value=Edytuj> </form> </a>
              </td>
              <td> <form method='POST' action='http://localhost/computer_service/public/deactivate_category' 
                accept-charset='UTF-8' class='form-horizontal'> 
                <input class='form-control' name='id' type='hidden' value='$category->id'>
                 <input class='btn btn-primary' type='submit' value=Dezaktywuj>
                 <input class='form-control' name='_method' type='hidden' value='DELETE'>
                 <input type='hidden' name='_token' value='<?php echo csrf_token() ?>'> </form> </a>
              </td>
              <td> <form method='POST' action='http://localhost/computer_service/public/activate_category' 
                accept-charset='UTF-8' class='form-horizontal'> 
                <input class='form-control' name='id' type='hidden' value='$category->id'>
                 <input class='btn btn-primary' type='submit' value=Aktywuj>
                 <input class='form-control' name='_method' type='hidden' value='PATCH'>
                 <input type='hidden'name='_token' value='<?php echo csrf_token() ?>'> </form> </a>
              </td>
          </tr>");

        }

        return ($content);
    }

    public function findCategories()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $data['data'] = htmlentities($data['data']);
        $data['data'] = stripslashes($data['data']);
        $categories = Category::where('name', 'LIKE', '%' . $data['data'] . '%')->get();
      
        switch(Auth::user()->getRole())
        {
            case 'admin':
            {
                $categories = Category::where('name', 'LIKE', '%' . $data['data'] . '%')->get();
                $content=$this->getSearchingResultsAdmin($categories);
                break;
            }
            case 'employee':
            {
                $categories = Category::where('name', 'LIKE', '%' . $data['data'] . '%')->where('active','=',true)->get();
                $content=$this->getSearchingResultsEmployee($categories);
                break;
            }
            case 'supervisor':
            {
                $categories = Category::where('name', 'LIKE', '%' . $data['data'] . '%')->get();
                $content=$this->getSearchingResultsSupervisor($categories);
                break;
            }
            case 'customer':
            {
                $categories = Category::where('name', 'LIKE', '%' . $data['data'] . '%')->where('active','=',true)->get();
                $content=$this->getSearchingResultsCustomer($categories);
                break;
            }
            default:
            {
                return;
            }
        }


        return json_encode($content);
    }
    public function storeCategory(CategoryRequest $request)
    {

        Category::create($request->toArray());
        Session::put('message', 'Kategoria została pomyślnie dodana!');
        return ("show_categories");
    }

    public function showCategoriesList()
    {

        switch (Auth::user()->getRole()) {
            case "employee":
                {
                    $categories = Category::where('active', '=', true)->get();

                    return view('categories.categories_list_e')->with('categories', $categories);
                }

            case "supervisor":
                {
                    $categories = Category::where('active', '=', true)->get();

                    return view('categories.categories_list_s')->with('categories', $categories);
                }

            case "admin":
                {
                    $categories = Category::all();

                    return view('categories.categories_list_a')->with('categories', $categories);
                }

            default:
                {
                    return view('pictures.access_denied');

                }

        }

    }

}
