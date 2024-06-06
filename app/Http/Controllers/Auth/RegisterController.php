<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\People;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'email' => ['required', 'string', 'regex:/^[a-zñA-ZÑ]+[a-zñA-ZÑ._-]*@uniempresarial\.edu\.co$/','unique:users'],
            'password' => ['required', 'string','max:20', 'confirmed', Password::min(8)->letters()->numbers()->symbols()],
        ],
        [
            'email.required' => 'Se requiere email',
            'email.unique' => 'Email ya registrado',
            'email.regex' => 'El correo electronico no es valido',
            'password.required' => 'Se requiere contraseña',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.max' => 'Caracteres máximos:15',
            'password.min' => 'Caracteres mínimos:8',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => "Por definir",
            'document' => 0,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_roles' => 1,
            'id_documents' => 1
        ]);

        return $user;
    }

}
