<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Helpers\DataArrayHelper;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'email' => 'required|email|unique:users',
            'organization' => 'required',
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
       return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'organization_id' => $data['organization'],
            'email' => $data['email'],
            'Role_id' => 1,
            'password' => Hash::make($data['password']),
            'verification_token' => DataArrayHelper::randomString(80),
        ]);
        
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $link = route('user.verification', $user->verification_token);

        $data = array( 
            'user' => $user,
            'verificationLink' => $link
        );
        DataArrayHelper::sendverificationMail($user, $data);
        // $this->guard()->login($user);
        flash('User has been created successfully. Please check your email address for verification')->success();
        return \Redirect::route('register');
        // return $this->registered($request, $user)
        //                 ?: redirect($this->redirectPath());
    }
}
