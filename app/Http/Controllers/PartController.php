<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PartRequest;
use App\Part;
class PartController extends Controller
{

    public function showPartForm()
    {
        $categories = Category::pluck('name','id');
        return view("parts.create_part")->with('categories',$categories);
    }

    public function storePart(PartRequest $request)
    {
        Part::create($request->toArray());
        return view("/");
    }

    public function showPartsList()
    {
        $parts = Part::with('category')->where('active','=',true)->get();

        return view ('parts.parts_list')->with('parts',$parts);
    }

   public function showPartEditForm($id)
   {
    $parts = Part::with('category')->where('active','=',true)->where('id','=',$id)->get();

    return view ('parts.part_edit_form')->with('parts',$parts); 
   }

   public function editPart(Request $request)
   {
    Part::update($request->toArray())->where('id','=',$request->input('id'));
    $parts = Part::with('category')->where('active','=',true)->get();

    return view ('parts.parts_list')->with('parts',$parts);
   }

}
