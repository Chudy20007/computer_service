<?php

namespace App\Http\Controllers;
use Auth;
use Session;
use App\Service;
use App\Http\Requests\ServiceRequest;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permissions',['except' => ['showServicesList','findServices']]);
    }

    public function showServiceForm ()
    {  
        return view('services.create_service');
    }

public function findServices()
{
    $data = json_decode(file_get_contents('php://input'), true);

        $data['data'] = htmlentities($data['data']);
        $data['data'] = stripslashes($data['data']);
        $categories = Service::where('name', 'LIKE', '%' . $data['data'] . '%')->get();

        $content = "";
        foreach ($categories as $category) {
            $content .= ("<tr class='table-light'><td>" . $category->name . "</td><td>" . $category->price . "</td></tr>");

        }

        return json_encode($content);
    
}

    public function showServiceEditForm ($id)
    {  
        $service=Service::where('id',$id)->get()->first();
       
        return view('services.edit_service')->with('service',$service);
    }

    public function editService(ServiceRequest $request)
    {
        $service = [
            'name' =>$request['name'],
            'price'=>$request['price'],
            
        ];
        $id =$request['id'];
        Service::where('id',$id)->update($service);
        Session::put('message', 'Usługa została pomyślnie zaktualizowana!');
 return redirect("show_services");
    }
    public function storeService (ServiceRequest $request)
    {
 
        Service::create($request->toArray());
        Session::put('message', 'Usługa została pomyślnie dodana!');
        return redirect("show_services");
    }

    public function showServicesList()
    {
        switch (Auth::user()->getRole())
        {
            case "employee":
            {
                $services = Service::where('active','=',true)->get();
                return view ('services.services_list_e')->with('services',$services);                 
            }

            case "supervisor":
            {
                $services = Service::where('active','=',true)->get();
                return view ('services.services_list_s')->with('services',$services);                   
            }

            case "admin":
            {
                $services = Service::all();
                return view ('services.services_list_a')->with('services',$services);                  
            }

            default:
            {
                $services = Service::where('active','=',true)->get();
                return view ('services.services_list')->with('services',$services);   
                 
            }

        }
 
    }
}
