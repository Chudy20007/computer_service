<?php
namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\User;
use App\Service;
use Auth;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('permissions',['except' => ['showEmployeesList']]);
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

        return redirect ('show_employees');
    }
}
