<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'city', 'local_number', 'post_code', 'street',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        if ($this->role === "admin") {
            return true;
        } else {
            return false;
        }

    }
    public function isSupervisor()
    {
        if ($this->role === "supervisor") {
            return true;
        } else {
            return false;
        }

    }
    public function isEmployee()
    {
        if ($this->role === "employee") {
            return true;
        } else {
            return false;
        }

    }

    public function isCustomer()
    {
        if ($this->role === "customer") {
            return true;
        } else {
            return false;
        }

    }

    public function getName()
    {
        return $this->name;
    }

    public function getRole()
    {
        return $this->role;
    }
    public function order()
    {
        $this->hasMany('App\Order', 'order_id')->where('customer_id', '=', $this->id);
    }

    public function order_employee_count()
    {
        return $this->hasMany('App\Order', 'employee_id')->where('employee_id', '=', $this->id)->where('status', '=', 'w toku')->count();
    }
    public function invoice()
    {
        $this->hasMany('App\Invoice', 'invoice_id')->where('customer_id', '=', $this->id);
    }

    public function complaint()
    {
        $this->hasMany('App\Complaint', 'complaint_id')->where('customer_id', '=', $this->id);
    }

}
