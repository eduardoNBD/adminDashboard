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

    public function Recovery(Request $request){
        if (Auth::check()) { 
            return redirect('/dashboard');
        }

        return view("recovery");
    }

    public function Reset(Request $request, $token){
        if (Auth::check()) { 
            return redirect('/dashboard');
        }
        
        $passwordResetToken = DB::table('password_reset_tokens')
        ->where('token', $token)
        ->first();

        return view("reset", ['token' => $passwordResetToken]);
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

    public function RecoverRequest(Request $request){ 
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email|exists:users,email|unique:password_reset_tokens'
        ],[
            'email.required' => 'Campo <strong>E-mail</strong> es requerido',
            'email.email' => 'Campo <strong>E-mail</strong> debe ser un correo electronico valido',
            'email.exists' => 'E-mail incorrecto',
            'email.unique' => 'Ya existe una petición de token con este correo, revisa tu E-mail o comunicate con un administrador para que elimine tu token',
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

    public function ResetRequest(Request $request){ 
        $validator = Validator::make(request()->all(), [ 
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ],[ 
            'email.required' => 'Campo <strong>E-mail</strong> es requerido',
            'email.email' => 'Campo <strong>E-mail</strong> debe ser un correo electronico valido',
            'password.required' => 'Campo <strong>Nueva contraseña</strong> es requerido', 
            'password_confirmation.required' => 'Campo <strong>Confirmar nueva contraseña</strong> es requerido',  
            'password.confirmed' => 'Campo <strong>Nueva contraseña</strong> debe coincidir con el <strong>Confirmar nueva Contraseña</strong>',
        ]);
   
        if ($validator->fails()){
            $messages = "";

            foreach ($validator->messages()->toArray() as $key => $message) {
                $messages.= $message[0]."<br>";
            }

            return response()->json(["status" => 0, "message" => $messages]);
        }

        $passwordReset = DB::table('password_reset_tokens')->where([
            ['token', $request->token],
            ['email', $request->email],
        ])->first();

        if (!$passwordReset) {
            return response()->json(["status" => 0, "message" => 'El token o email de restablecimiento es inválido.']); 
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(["status" => 0, "message" => "Usuario inexistente"]); 
        }
        
        $user->password = Hash::make($request->password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json(["status" => 1, "message" => "Contraseña cambiada, te redirigiremos a la pagina de inicio de sesión"]); 
    }
}
