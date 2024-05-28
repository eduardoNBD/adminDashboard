<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;


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

    public function Recovery(Request $request){
        if (Auth::check()) { 
            return redirect('/dashboard');
        }

        return view("recovery");
    }

    public function RecoverRequest(Request $request){ 
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email'
        ],[
            'email.required' => 'Campo <strong>E-mail</strong> es requerido',
            'email.email' => 'Campo <strong>E-mail</strong> debe ser un correo electronico valido',
        ]);
   
        if ($validator->fails()){
            $messages = "";

            foreach ($validator->messages()->toArray() as $key => $message) {
                $messages.= $message[0]."<br>";
            }

            return response()->json(["status" => 0, "message" => $messages]);
        }

        $token = Str::random(60);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        Mail::send('reset-email', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Enlace de restablecimiento de contraseña');
        });

        return response()->json(["status" => 1, "message" => "Te hemos enviado el enlace para restablecer tu contraseña a tu correo electrónico.'"]); 
    }

    public function Reset(Request $request, $token){
        if (Auth::check()) { 
            return redirect('/dashboard');
        }

        return view("reset", ['token' => $token]);
    }

    public function ResetRequest(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $validator = Validator::make(request()->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ],[
            'email.email' => 'Campo <strong>E-mail</strong> es requerido',
            'email.required' => 'Campo <strong>E-mail</strong> es requerido',
            'email.email' => 'Campo <strong>E-mail</strong> debe ser un correo electronico valido',
        ]);
   
        if ($validator->fails()){
            $messages = "";

            foreach ($validator->messages()->toArray() as $key => $message) {
                $messages.= $message[0]."<br>";
            }

            return response()->json(["status" => 0, "message" => $messages]);
        }

        $passwordReset = DB::table('password_resets')->where([
            ['token', $request->token],
            ['email', $request->email],
        ])->first();

        if (!$passwordReset) {
            return back()->withErrors(['email' => 'El token de restablecimiento es inválido.']);
        }

        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No podemos encontrar un usuario con esa dirección de correo electrónico.']);
        }

        $user->password = Hash::make($request->password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Tu contraseña ha sido restablecida!'); 
    }
}
