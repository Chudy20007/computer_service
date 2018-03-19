<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Illuminate\Http\Request;

class EmployeeControler extends Controller
{
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
}
