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

}
