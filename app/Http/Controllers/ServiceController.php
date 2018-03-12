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
 
        $service = Service::create($request->toArray());
        return ("Success!");
    }
}
