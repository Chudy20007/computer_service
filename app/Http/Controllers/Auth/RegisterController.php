<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permissions');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required','regex:/^([A-Z]{1}[a-z]{2,15}\s[A-Z]{1}[a-z]{2,15})$/'],
            'email' => ['required','email','unique:users'],
            'password' => ['required'],
            'phone' => ['required','regex:/^[0-9]{8,}$/','unique:users'],
            'role' => ['required','regex:/^([a-z]{4,})$/'],
            'post-code' =>['required','regex:/^([0-9]{2})-([0-9]{3})$/'],
            'local-number' => ['required'],
            'file' =>['required'],
            'street' =>['required']

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $id = User::latest('id')->first();
        $id['id'] = $id['id'] + 1;
        $files = Input::file('file');

        $files->move('C:\xampp\htdocs\computer_service\public\css\img\avatars', $id['id'] . ".jpg");
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role' => $data['role'],
            'city' => $data['city'],
            'street' => $data['street'],
            'local_number' => $data['local-number'],
            'post_code' => $data['post-code'],
            'password' => bcrypt($data['password']),
        ]);
        Session::put('message', 'Użytkownik został pomyślnie zarejestrowany!');
    }
}
