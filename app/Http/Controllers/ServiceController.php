<?php

namespace App\Http\Controllers;
use Auth;
use App\Service;
use App\Http\Requests\ServiceRequest;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permissions');
    }

    public function showServiceForm ()
    {  
        return view('services.create_service');
    }

    public function storeService (ServiceRequest $request)
    {
 
        Service::create($request->toArray());
        return view("/");
    }

    public function showServicesList()
    {
        $services = Service::where('active','=',true)->get();

        return view ('services.services_list')->with('services',$services);
    }
}
