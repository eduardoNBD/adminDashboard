<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function Login()
    {
        if (Auth::check()) { 
            return redirect('/dashboard');
        }

        return view("login");
    }

    public function Logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route("login"));
    }

    public function LoginRequest(Request $request)
    { 
        $validator = Validator::make(request()->all(), [
            'username' => 'required',
            'password' => 'required'
        ],
        [
            'username.required' => 'Campo <strong>Usuario</strong> requerido',
            'password.required' => 'Campo <strong>Contraseña</strong> requerido'
        ]);
   
        if ($validator->fails()){
            $messages = "";

            foreach ($validator->messages()->toArray() as $key => $message) {
                $messages.= $message[0]."<br>";
            }

            return response()->json(["status" => 0, "message" => $messages]);
        }

        $username = $request->input("username");
        $password = $request->input("password");

        $credentials = [
            'username' => $username,
            'password' => $password,
        ];

        if(Auth::attempt($credentials)){
            Session::put('timezone', $request->input("timezone"));
            return response()->json(["status" => 1, "message" => "Logged"]);
        }
        else{
            return response()->json(["status" => 0, "message" => "Usuario o contraseña erronea"]);
        }
    }
}
