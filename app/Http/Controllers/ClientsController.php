<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Client;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Auth;

class ClientsController extends Controller
{
    public function create(Request $request){
        
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email|unique:clients', 
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required|unique:clients',
        ],
        [
            'name.required' => 'Campo <strong>Nombre</strong> es requerido',
            'email.unique' => 'Ya existe un cliente con ese email', 
            'email.required' => 'Campo <strong>email</strong> es requerido', 
            'email.email' => 'Campo <strong>email</strong> debe ser un email valido',  
            'lastname.required' => 'Campo <strong>Precio</strong> requerido', 
            'phone.required' => 'Campo <strong>Teléfono</strong> es requerido',
            'phone.unique' => 'Ya existe un cliente con ese Teléfono',  
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
           
        $client = new Client;
        
        $client->name     = $request->input("name");
        $client->lastname = $request->input("lastname");
        $client->email    = $request->input("email");
        $client->phone    = $request->input("phone");
        $client->modify_by = Auth::id();
        $client->save(); 
        
        return response()->json(["status" => 1, "message" => "Cliente guardado"]);
    } 

    public function update(Request $request, $id){
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email|unique:clients,email,'.$id, 
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required|unique:clients,phone,'.$id, 
        ],
        [
            'name.required' => 'Campo <strong>Nombre</strong> es requerido',
            'email.unique' => 'Ya existe un cliente con ese email', 
            'email.required' => 'Campo <strong>email</strong> es requerido', 
            'email.email' => 'Campo <strong>email</strong> debe ser un email valido',  
            'lastname.required' => 'Campo <strong>Precio</strong> requerido', 
            'phone.required' => 'Campo <strong>Teléfono</strong> es requerido',
            'phone.unique' => 'Ya existe un cliente con ese Teléfono',  
        ]);

        if ($validator->fails()){
            $messages = "";

            foreach ($validator->messages()->toArray() as $key => $errMessages) {
                foreach ($errMessages as $key => $errMessage) {
                    $messages.= $errMessage."<br>";
                }
                
            }

            return response()->json(["status" => 0, "message" => $messages.'--'.$id]);
        }

        $client = Client::findOr($id, function () {
            return false;
        });

        if(!$client){
            return response()->json(["status" => 0, "message" => "Cliente no encontrado"]);
        }

        if($client->status == 0)
        {
            return response()->json(["status" => 0, "message" => "Cliente Eliminado"]);
        }

        $client->name     = $request->input("name");
        $client->lastname = $request->input("lastname");
        $client->email    = $request->input("email");
        $client->phone    = $request->input("phone");
        $client->modify_by = Auth::id();
        $client->save(); 

        return response()->json(["status" => 1, "message" => "Cliente guardado " ]);
    }

    public function list(Request $request){ 
        $client = new Client; 
 
        $clients = $client->where("status",1);

        if($request->input("s"))
        {
            $clients->where('name', 'like', $request->input("s") . '%')
                    ->orWhere('lastname', 'like', $request->input("s") . '%')
                    ->orWhere('phone', 'like', $request->input("s") . '%')
                    ->orWhere('email', 'like', $request->input("s") . '%');
        }

        $perPage = 10; 
        $page = $request->input("page") ?: 1; 
    
        $totalClients = $clients->count();

        $totalPages = ceil($totalClients / $perPage);

        $page = min($page, $totalPages);

        $clients = $clients->paginate($perPage, ['id', 'name', 'lastname', 'email', 'phone'], 'clients', $page);
         
        return response()->json(["status" => 1, 'clients' => $clients, 's' => $request->input("s")] );
    } 

    public function delete(Request $request, $id){ 
        $client = Client::findOr($id, function () {
            return false;
        });

        if(!$client){
            return response()->json(["status" => 0, "message" => "Cliente no encontrado"]);
        }
        
        $client->status = 0;
        $client->save(); 

        return response()->json(["status" => 1, "clients" => $client]);
    }  
}

