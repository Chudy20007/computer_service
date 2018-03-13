<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class EmployeeControler extends Controller
{
    public function showEmployeesList()
    {
        $employees = User::where('role','employee')->orWhere('role','supervisor')->get(['name','email','phone','role','id']);
        return view ('employees.employees_list')->with('users',$employees);
    }
}
