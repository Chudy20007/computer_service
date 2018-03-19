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
    $part = Part::with('category')->where('active','=',true)->where('id','=',$id)->get()->first();

    $categories = Category::where('active','=',true)->pluck('name','id');
    return view ('parts.edit_part')->with('part',$part)->with('categories',$categories); 
   }

   public function editPart(PartRequest $request)
   {
       
       $datas=[
        'name'=>$request->name,
        'serial_number'=>$request->serial_number,
        'category_id'=>$request->category_id,
        'price'=>$request->price,
        'count'=>$request->count
       ];

       
    Part::where('id','=',$request->id)->update($datas);
    $parts = Part::with('category')->where('active','=',true)->get();

    return view ('parts.parts_list')->with('parts',$parts);
   }

}
