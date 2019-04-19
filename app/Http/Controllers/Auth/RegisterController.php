<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Pusher\Pusher;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    // protected $redirectTo = '/admin/user/index';
    protected function redirectTo()
    {
        if (Auth::user()) {
            if (Auth::user()->role_id == 3) {
                return '/';
            }
        }

        return '/admin/user/index';
    }

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
        return Validator::make(
            $data, [
                'name'     => 'required|string|max:255',
                'email'    => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
                'address'  => 'required|string',
                'phone'    => 'required|digits_between:9,11',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $data['active'] = 0;

        if ($data['role'] == 3) {
            $data['active'] = 1;
        }

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'address'  => $data['address'],
            'phone'    => $data['phone'],
            'role_id'  => $data['role'],
            'active'   => $data['active'],
        ]);

        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = [
            'id' => $user->id,
            'user_avatar' => null,
            'user_name' => $data['name'],
            'active' => $data['active'],
        ];
        try {
            $pusher->trigger(
                'UserEvent',
                'send-user',
                $data
            );
        } catch (\Exception $e) {
            dd($e);
        }

        return $user;
    }
}
