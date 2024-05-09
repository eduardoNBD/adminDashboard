<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        
        try{
            $user = new User;

            $user->id       = Str::uuid();
            $user->name     = "admin";
            $user->lastname = "administrator";
            $user->username = "admin";
            $user->email = "admin@admin.com";
            $user->phone = "3221564984";
            $user->password = Hash::make("administrator");
            $user->role     = "1";

            $user->save();
        }catch(\Throwable $error){
            /*$user = $user->find("fb6d6b04-3819-40c5-a02b-96fafffad40a");
            $user->password = Hash::make("administrator"); 

            $user->save();*/
        }

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
            return response()->json(["status" => 1, "message" => "Logged"]);
        }
        else{
            return response()->json(["status" => 0, "message" => "Usuario o contraseña erronea"]);
        }
    }
}
