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
