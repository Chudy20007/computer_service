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
        $this->middleware('permissions',['except' => ['showServicesList','findServices','sortServices']]);
    }

    public function showServiceForm ()
    {  
        return view('services.create_service');
    }

    public function sortServices()
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
                $services = Service::orderBy($data['column_name'],$data['data_sort'])->get();
                $content=$this->getSearchingResultsAdmin($services);
                break;
            }
            case 'employee':
            {
                $services = Service::where('active',true)->orderBy($data['column_name'],$data['data_sort'])->get();
                $content=$this->getSearchingResultsEmployee($services);
                break;
            }
            case 'supervisor':
            {
                $services = Service::orderBy($data['column_name'],$data['data_sort'])->get();
                $content=$this->getSearchingResultsSupervisor($services);
                break;
            }
            case 'customer':
            {
                $services = Service::where('active',true)->orderBy($data['column_name'],$data['data_sort'])->get();
                $content=$this->getSearchingResultsCustomer($services);
                break;
            }
            default:
            {
                return;
            }
        }


        return json_encode($content);
    }
    public function getSearchingResultsCustomer($services)
    {
        $content = "";
        foreach ($services as $service) {
            $content .= ("<tr class='table-light'>
            <td>$service->name</td>
            <td>".number_format($service->price,2)." PLN</td></tr>");
        }
        return $content;
    }

    public function getSearchingResultsEmployee($services)
    {
        $content = "";
        foreach ($services as $service) {
            $content .= ("<tr class='table-light'>
            <td>$service->name</td>
            <td>".number_format($service->price,2)." PLN</td></tr>");
        }
        return $content;
    }
    public function getSearchingResultsAdmin($services)
    {
        $content = "";
        foreach ($services as $service) {
            $content .= ("<tr class='table-light'>
            <td>$service->name</td>
            <td>".number_format($service->price,2)." PLN</td>
            <td> $service->created_at</td>
            <td>".($service->active==1 ?'tak':'nie')."</td>
            <td> <form method='GET' action='http://localhost/computer_service/public/edit_service/$service->id' 
                accept-charset='UTF-8' class='form-horizontal'> 
                <input class='form-control' name='id' type='hidden' value='$service->id'>
                 <input class='btn btn-primary' type='submit' value=Edytuj> </form> </a>
              </td>
              <td> <form method='POST' action='http://localhost/computer_service/public/deactivate_service' 
                accept-charset='UTF-8' class='form-horizontal'> 
                <input class='form-control' name='id' type='hidden' value='$service->id'>
                 <input class='btn btn-primary' type='submit' value=Dezaktywuj>
                 <input class='form-control' name='_method' type='hidden' value='DELETE'>
                 <input type='hidden' name='_token' value='<?php echo csrf_token() ?>'> </form> </a>
              </td>
              <td> <form method='POST' action='http://localhost/computer_service/public/activate_service' 
                accept-charset='UTF-8' class='form-horizontal'> 
                <input class='form-control' name='id' type='hidden' value='$service->id'>
                 <input class='btn btn-primary' type='submit' value=Aktywuj>
                 <input class='form-control' name='_method' type='hidden' value='PATCH'>
                 <input type='hidden'name='_token' value='<?php echo csrf_token() ?>'> </form> </a>
              </td>
          </tr>");

        }
        return $content;
    }

    public function getSearchingResultsSupervisor($services)
    {
        $content = "";
        foreach ($services as $service) {
            $content .= ("<tr class='table-light'>
            <td>$service->name</td>
            <td>".number_format($service->price,2)." PLN</td>
            <td> $service->created_at</td>
            <td> <form method='GET' action='http://localhost/computer_service/public/edit_service/$service->id' 
                accept-charset='UTF-8' class='form-horizontal'> 
                <input class='form-control' name='id' type='hidden' value='$service->id'>
                 <input class='btn btn-primary' type='submit' value=Edytuj> </form> </a>
              </td>
          </tr>");

        }
        return $content;
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
        if (Auth::user())
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
            case "customer":
            {
                $services = Service::all();
                return view ('services.services_list_c')->with('services',$services);                  
            }
            default:
            {
                $services = Service::where('active','=',true)->get();
                return view ('services.services_list')->with('services',$services);   
                 
            }

        }
    }
    else
    {
            $services = Service::where('active','=',true)->get();
            return view ('services.services_list')->with('services',$services);   
             
        
    }
 
    }
}
