<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PartRequest;
use App\Part;
use Session;
use Auth;

class PartController extends Controller
{

    public function showPartForm()
    {
        $categories = Category::pluck('name', 'id');
        return view("parts.create_part")->with('categories', $categories);
    }


    public function findParts()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $data['data'] = htmlentities($data['data']);
        $data['data'] = stripslashes($data['data']);
        $parts = Part::with('category')->where('name', 'LIKE', '%' . $data['data'] . '%')->get();
       
$token=$data['token'];
        $content = "";
        foreach ($parts as $part) {
   
            $content .= ("<tr class='table-light'><td>" . $part->category->name . "</td><td>" . $part->name . "</td>");
            $content.=("<td>".$part->count."</td><td>".$part->price."</td><td>" . $part->updated_at . "</td></tr>");
          
        }

        return json_encode($content);
    }



    public function storePart(PartRequest $request)
    {
        Part::create($request->toArray());
        Session::put('message', 'Część została pomyślnie dodana!');
        return redirect("show_parts");
    }

    public function sortParts()
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
                $parts = Part::with('category')->orderBy('parts.'.$data['column_name'],$data['data_sort'])->get();
                $content=$this->getSearchingResultsAdmin($parts);
                break;
            }
            case 'employee':
            {
                $parts = Part::with('category')->where('active',true)->orderBy('parts.'.$data['column_name'],$data['data_sort'])->get();
                $content=$this->getSearchingResultsEmployee($parts);
                break;
            }
            case 'supervisor':
            {
                $parts = Part::with('category')->orderBy('parts.'.$data['column_name'],$data['data_sort'])->get();
                $content=$this->getSearchingResultsSupervisor($parts);
                break;
            }
    
            default:
            {
                return;
            }
        }


        return json_encode($content);
    }

    public function getSearchingResultsSupervisor($parts)
    {
        $content = "";
        foreach ($parts as $part) {
            $category=$part->category->name;
            $content .= ("<tr class='table-light'>
            <td>$category</td>
            <td>$part->name</td>
            <td>$part->count</td>
            <td>".number_format($part->price,2)." PLN</td>
            <td>$part->created_at</td>
            <td>$part->updated_at</td>
            <td>".($part->active ? 'tak' : 'nie')."</td>
            <td> <form method='GET' action='http://localhost/computer_service/public/edit_part/$part->id' 
                accept-charset='UTF-8' class='form-horizontal'> 
                <input class='form-control' name='id' type='hidden' value='$part->id'>
                 <input class='btn btn-primary' type='submit' value='Edytuj'> </form> </a>
                 <input type='hidden'name='_token' value=".csrf_token()."> </form> </a>
                 </td> 
                 </tr>");
        }
        return $content;
    }
    public function getSearchingResultsEmployee($parts)
    {
        $content = "";
        foreach ($parts as $part) {
            $category=$part->category->name;
            $content .= ("<tr class='table-light'>
            <td>$category</td>
            <td>$part->name</td>
            <td>$part->count</td>
            <td>".number_format($part->price,2)." PLN</td>
            <td>$part->updated_at</td>
                 </tr>");
        }
        return $content;
    }

    public function getSearchingResultsAdmin($parts)
    {
        $content = "";
        foreach ($parts as $part) {
            $category=$part->category->name;
            $content .= ("<tr class='table-light'>
            <td>$category</td>
            <td>$part->name</td>
            <td>$part->count</td>
            <td>".number_format($part->price,2)." PLN</td>
            <td>$part->created_at</td>
            <td>$part->updated_at</td>
            <td>".($part->active ? 'tak' : 'nie')."</td>
            <td> <form method='GET' action='http://localhost/computer_service/public/edit_part/$part->id' 
                accept-charset='UTF-8' class='form-horizontal'> 
                <input class='form-control' name='id' type='hidden' value='$part->id'>
                 <input class='btn btn-primary' type='submit' value='Edytuj'> </form> </a>
                 <input type='hidden'name='_token' value=".csrf_token()."> </form> </a>
                 </td>
                 <td> <form method='POST' action='http://localhost/computer_service/public/deactivate_part' 
                    accept-charset='UTF-8' class='form-horizontal'> 
                    <input class='form-control' name='id' type='hidden' value='$part->id'>
                     <input class='btn btn-primary' type='submit' value='Dezaktywuj'>
                     <input class='form-control' name='_method' type='hidden' value='DELETE'> </form> </a>
                     <input type='hidden'name='_token' value=".csrf_token()."> </form> </a>
                     </td>    
                     <td> <form method='POST' action='http://localhost/computer_service/public/activate_part' 
                        accept-charset='UTF-8' class='form-horizontal'> 
                        <input class='form-control' name='id' type='hidden' value='$part->id'>
                        <input class='form-control' name='_method' type='hidden' value='PATCH'>
                         <input class='btn btn-primary' type='submit' value='Aktywuj'> </form> </a>
                         <input type='hidden'name='_token' value=".csrf_token()."> </form> </a>
                         </td>  
                 </tr>");
        }
        return $content;
    }

    public function showPartsList()
    {

        switch (Auth::user()->getRole()) {
            case "employee":
                {
                    $parts = Part::with('category')->where('active', '=', true)->get();

                    return view('parts.parts_list_e')->with('parts', $parts);
                }

            case "supervisor":
                {
                    $parts = Part::with('category')->where('active', '=', true)->get();

                    return view('parts.parts_list_s')->with('parts', $parts);
                }

            case "admin":
                {
                    $parts = Part::with('category')->get();

                    return view('parts.parts_list_a')->with('parts', $parts);
                }

            default:
                {
                    return redirect('pictures.access_denied');

                }
        }

    }

    public function showPartEditForm($id)
    {
        $part = Part::with('category')->where('active', '=', true)->where('id', '=', $id)->get()->first();

        $categories = Category::where('active', '=', true)->pluck('name', 'id');
        return view('parts.edit_part')->with('part', $part)->with('categories', $categories);
    }

    public function editPart(PartRequest $request)
    {

        $datas = [
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'count' => $request->count,
        ];

        Part::where('id', '=', $request->id)->update($datas);

        switch (Auth::user()->getRole()) {
            case "admin":
                { $parts = Part::with('category')->get();
                    return view('parts.parts_list_a')->with('parts', $parts);
                }

            case "supervisor":
                { $parts = Part::with('category')->where('active', '=', true)->get();
                    return view('parts.parts_list_s')->with('parts', $parts);
                }
        }

    }

}
