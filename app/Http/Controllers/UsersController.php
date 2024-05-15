<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function create(Request $request){
        
        $validator = Validator::make(request()->all(), [
            'username' => 'required|unique:users', 
            'role' => 'required', 
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users', 
            'phone' => 'required|unique:users',
            'password' => 'required|confirmed',
        ],
        [
            'username.unique' => 'Ya existe un usuario con ese <strong>nombre de usuario</strong>', 
            'username.required' => 'Campo <strong>nombre de usuario</strong> es requerido', 
            'role.required' => 'Campo <strong>Rol de usuario</strong> es requerido',
            'name.required' => 'Campo <strong>Nombre</strong> es requerido',
            'lastname.required' => 'Campo <strong>Apellido</strong> es requerido', 
            'email.unique' => 'Ya existe un usuario con ese email', 
            'email.required' => 'Campo <strong>email</strong> es requerido', 
            'email.email' => 'Campo <strong>email</strong> debe ser un email valido',  
            'phone.required' => 'Campo <strong>Teléfono</strong> es requerido',
            'password.required' => 'Campo <strong>Contraseña</strong> es requerido',  
            'password.confirmed' => 'Campo <strong>Contraseña</strong> debe coincidir con el <strong>Confirmar Contraseña</strong> ',  
        ]);

        if ($validator->fails()){
            $messages = "";

            foreach ($validator->messages()->toArray() as $key => $errMessages) {
                foreach ($errMessages as $key => $errMessage) {
                    $messages.= $errMessage."<br>";
                }
                
            }

            return response()->json(["status" => 0, "message" => $messages]);
        } 

        $user = new User;
 
        $user->name     = $request->input("name");
        $user->lastname = $request->input("lastname");
        $user->username = $request->input("username");
        $user->email = $request->input("email");
        $user->phone = $request->input("phone");
        $user->password = Hash::make($request->input("password"));
        $user->role     = $request->input("role");

        $user->save();
        
        return response()->json(["status" => 1, "message" => "Usuario guardado"]);
    } 

    public function update(Request $request, $id){

        $validator = Validator::make(request()->all(), [
            'username' => 'required|unique:users,username,'.$id,
            'role' => 'required', 
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|unique:users,phone,'.$id,
        ],
        [
            'username.unique' => 'Ya existe un usuario con ese <strong>nombre de usuario</strong>', 
            'username.required' => 'Campo <strong>nombre de usuario</strong> es requerido', 
            'role.required' => 'Campo <strong>Rol de usuario</strong> es requerido',
            'name.required' => 'Campo <strong>Nombre</strong> es requerido',
            'lastname.required' => 'Campo <strong>Apellido</strong> es requerido', 
            'email.unique' => 'Ya existe un usuario con ese email', 
            'email.required' => 'Campo <strong>email</strong> es requerido', 
            'email.email' => 'Campo <strong>email</strong> debe ser un email valido',  
            'phone.required' => 'Campo <strong>Teléfono</strong> es requerido',  
            'phone.unique' => 'Ya existe un usuario con ese telefono',  
        ]);

        if ($validator->fails()){
            $messages = "";

            foreach ($validator->messages()->toArray() as $key => $errMessages) {
                foreach ($errMessages as $key => $errMessage) {
                    $messages.= $errMessage."<br>";
                }
                
            }

            return response()->json(["status" => 0, "message" => $messages ]);
        }

        $user = User::findOr($id, function () {
            return false;
        });

        if(!$user){
            return response()->json(["status" => 0, "message" => "Usuario no encontrado"]);
        }

        if($user->status == 0)
        {
            return response()->json(["status" => 0, "message" => "Usuario Eliminado"]);
        }

        $user->name     = $request->input("name");
        $user->lastname = $request->input("lastname");
        $user->username = $request->input("username");
        $user->email = $request->input("email");
        $user->phone = $request->input("phone"); 
        $user->role     = $request->input("role");

        $user->save();

        return response()->json(["status" => 1, "message" => "Servicio guardado " ]);
    }

    public function list(Request $request){ 
        $user = new User;

        $users = $user->where("status",1);

        if($request->input("s"))
        {
            $users->where('name', 'like', $request->input("s") . '%')
                  ->orWhere('lastname', 'like', $request->input("s") . '%')
                  ->orWhere('email', 'like', $request->input("s") . '%')
                  ->orWhere('phone', 'like', $request->input("s") . '%')
                  ->orWhere('username', 'like', $request->input("s") . '%');
        }

        $perPage = 10; 
        $page = $request->input("page") ?: 1; 
    
        $totalUsers = $users->count();
        $totalPages = ceil($totalUsers / $perPage);

        $page = min($page, $totalPages);

        $users = $users->paginate($perPage, ['id', 'name', 'lastname', 'username','email', 'role', 'phone'], 'users', $page);
         
        return response()->json(["status" => 1, 'users' => $users, 's' => $request->input("s")] );
    } 

    public function delete(Request $request, $id){ 
        $user = User::findOr($id, function () {
            return false;
        });

        if(!$user){
            return response()->json(["status" => 0, "message" => "Servicio no encontrado"]);
        }
        
        $user->status = 0;
        $user->save(); 

        return response()->json(["status" => 1, "services" => $user]);
    }  
}

