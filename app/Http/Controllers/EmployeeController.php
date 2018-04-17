<?php
namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\User;
use App\Service;
use Auth;
use Session;
class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('permissions',['except' => ['showEmployeesList','findEmployees','sortEmployees']]);
    }

    public function findEmployees()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $data['data'] = htmlentities($data['data']);
        $data['data'] = stripslashes($data['data']);
        $users = User::where('name', 'LIKE', '%' . $data['data'] . '%')->get();
       
$token=$data['token'];
        $content = "";
        foreach ($users as $user) {
   
            $content .= ("<tr class='table-light'><td>" . $user->name . "</td>");
            $content.=("<td>".$user->email."</td><td>".$user->phone."</td>");
            $content.=("<td><form class='form-horizontal' method='POST' action='http://localhost/computer_service/public/send_message/$user->id'>");
            $content.=(csrf_field());
            $content.=("<input class='btn btn-primary' type='submit' value='Wyślij wiadomość e-mail'></form></td></tr>");
        }

        return json_encode($content);
    }

    public function sortEmployees()
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
                $users = User::orderBy($data['column_name'],$data['data_sort'])->get();
                $content=$this->getSearchingResultsAdmin($users);
                break;
            }
            case 'employee':
            {
                $users = User::where('active',true)->where('role','!=','customer')->where('role','!=','admin')->orderBy($data['column_name'],$data['data_sort'])->get();
                $content=$this->getSearchingResultsEmployee($users);
                break;
            }
            case 'supervisor':
            {
                $users = User::where('active','=',true)->where('role','!=','customer')->where('role','!=','admin')->orderBy($data['column_name'],$data['data_sort'])->get();
                $content=$this->getSearchingResultsSupervisor($users);
                break;
            }
    
            default:
            {
                return;
            }
        }


        return json_encode($content);
    }
    public function getSearchingResultsEmployee($users)
    {
        $content = "";
        foreach ($users as $user) {
            $content .= ("<tr class='table-light'>
            <td><a href='http://localhost/computer_service/public//user/$user->id'>$user->name</a></td>
            <td>$user->email</td>
            <td>$user->phone</td>
            <td> <form method='POST' action='http://localhost/computer_service/public/send_message/$user->id' 
                accept-charset='UTF-8' class='form-horizontal'> 
                <input class='form-control' name='id' type='hidden' value='$user->id'>
                 <input class='btn btn-primary' type='submit' value='Wyślij wiadomość e-mail'> </form> </a>
                 <input type='hidden'name='_token' value=".csrf_token()."> </form> </a>
                 </td></tr>");
        }
        return $content;
    }
    public function getSearchingResultsSupervisor($users)
    {
        $content = "";
        foreach ($users as $user) {
            $content .= ("<tr class='table-light'>
            <td><a href='http://localhost/computer_service/public//user/$user->id'>$user->name</a></td>
            <td>$user->email</td>
            <td>$user->phone</td>
            <td>$user->role</td>
            <td> <form method='POST' action='http://localhost/computer_service/public/send_message/$user->id' 
                accept-charset='UTF-8' class='form-horizontal'> 
                <input class='form-control' name='id' type='hidden' value='$user->id'>
                 <input class='btn btn-primary' type='submit' value='Wyślij wiadomość e-mail'> </form> </a>
                 <input type='hidden'name='_token' value=".csrf_token()."> </form> </a>
                 </td></tr>");
        }
        return $content;
    }  
    public function getSearchingResultsAdmin($users)
    {
        $content = "";
        foreach ($users as $user) {
            $content .= ("<tr class='table-light'>
            <td><a href='http://localhost/computer_service/public//user/$user->id'>$user->name</a></td>
            <td>$user->email</td>
            <td>$user->phone</td>
            <td>$user->role</td>
            <td>".($user->active == 1 ? 'tak' : 'nie')."</td>
            <td> <form method='POST' action='http://localhost/computer_service/public/send_message/$user->id' 
                accept-charset='UTF-8' class='form-horizontal'> 
                <input class='form-control' name='id' type='hidden' value='$user->id'>
                 <input class='btn btn-primary' type='submit' value='Wyślij wiadomość e-mail'> </form> </a>
                 <input type='hidden'name='_token' value=".csrf_token()."> </form> </a>
                 </td>
                 <td> <form method='GET' action='http://localhost/computer_service/public/edit_employee/$user->id' 
                    accept-charset='UTF-8' class='form-horizontal'> 
                    <input class='form-control' name='id' type='hidden' value='$user->id'>
                     <input class='btn btn-primary' type='submit' value='Edytuj'> </form> </a>
                     <input type='hidden'name='_token' value=".csrf_token()."> </form> </a>
                     </td>     
                   <td> <form method='POST' action='http://localhost/computer_service/public/deactivate_employee' 
                        accept-charset='UTF-8' class='form-horizontal'> 
                        <input class='form-control' name='id' type='hidden' value='$user->id'>
                         <input class='btn btn-primary' type='submit' value='Dezaktywuj'>
                         <input class='form-control' name='_method' type='hidden' value='DELETE'> </form> </a>
                         <input type='hidden'name='_token' value=".csrf_token()."> </form> </a>
                         </td>    
                         <td> <form method='POST' action='http://localhost/computer_service/public/activate_employee' 
                            accept-charset='UTF-8' class='form-horizontal'> 
                            <input class='form-control' name='id' type='hidden' value='$user->id'>
                            <input class='form-control' name='_method' type='hidden' value='PATCH'>
                             <input class='btn btn-primary' type='submit' value='Aktywuj'> </form> </a>
                             <input type='hidden'name='_token' value=".csrf_token()."> </form> </a>
                             </td>  
                 </tr>");
        }
        return $content;
    }  
    public function showEmployeesList()
    {
        switch (Auth::user()->getRole())
        {
            case "employee":
            {
                $employees = User::where('role','employee')->orWhere('role','supervisor')->where('active','=',true)->get(['name','email','phone','role','id']);
                return view ('employees.employees_list_e')->with('users',$employees);                
            }

            case "supervisor":
            {
                $employees = User::where('role','employee')->orWhere('role','supervisor')->where('active','=',true)->get(['name','email','phone','role','id']);
                return view ('employees.employees_list_s')->with('users',$employees);                
            }

            case "admin":
            {
                $employees = User::all();
                return view ('employees.employees_list_a')->with('users',$employees);                  
            }

            default:
            {
                $services = Service::where('active','=',true)->get();
                return view ('pictures.access_denied'); 
                 
            }

        }


    }

    public function showEmployeeEditForm($id)
    {
        $employee=User::where('id',$id)->get()->first();
        
        return view('employees.edit_employee')->with('user',$employee);

    }

    public function editEmployee(EmployeeRequest $request)
    {
        $employee=[
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'active' => $request->active,
            'phone' => $request->phone,
            'street' => $request->street,
            'city' => $request->city,
            'local_number' => $request->local_number,
            'post_code' => $request->post_code,
            'password' => bcrypt($request->password)
        ];

        User::where('id',$request->id)->update($employee);
        Session::put('message', 'Pracownik został pomyślnie zaktualizowany!');
        return redirect ('show_employees');
    }
}
