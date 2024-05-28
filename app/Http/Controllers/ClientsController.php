<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Client;
use App\Models\Log;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $log = new Log;

        $log->action = "create_client";
        $log->detail = json_encode(["id" => $client->id, "name" => $client->name." ".$client->lastname, "data" => [
            "name"     => $client->name,
            "lastname" => $client->lastname,
            "email"    => $client->email,
            "phone"    => $client->phone,]
        ]);
        $log->user = Auth::id();
        
        $log->save();
        
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

        $prevData = [
            "name"     => $client->name,
            "lastname" => $client->lastname,
            "email"    => $client->email,
            "phone"    => $client->phone,
        ];

        $client->name     = $request->input("name");
        $client->lastname = $request->input("lastname");
        $client->email    = $request->input("email");
        $client->phone    = $request->input("phone");
        $client->modify_by = Auth::id();
        $client->save(); 

        $newData = [
            "name"     => $client->name,
            "lastname" => $client->lastname,
            "email"    => $client->email,
            "phone"    => $client->phone,
        ];

        $log = new Log;

        $log->action = "update_client";
        $log->detail = json_encode([
            "id" => $client->id,
            "name" =>  $client->name." ".$client->lastname,
            "prevData" => $prevData,
            "newData" => $newData
        ]);
        $log->user = Auth::id();
        
        $log->save();

        return response()->json(["status" => 1, "message" => "Cliente guardado " ]);
    }

    public function list(Request $request){ 
        $client = new Client; 
 
        $clients = $client->whereIn("status",$request->input("status"));

        if($request->input("s"))
        {
            $clients->where(function ($query) use ($request) {
                $query->where('name', 'like', $request->input("s") . '%')
                    ->orWhere('lastname', 'like', $request->input("s") . '%')
                    ->orWhere('phone', 'like', $request->input("s") . '%')
                    ->orWhere('email', 'like', $request->input("s") . '%');
            });
        }

        $perPage = 10; 
        $page = $request->input("page") ?: 1; 
    
        $totalClients = $clients->count();

        $totalPages = ceil($totalClients / $perPage);

        $page = min($page, $totalPages);

        $clients = $clients->select([
            'clients.id',
            'clients.name',
            'clients.lastname',
            'clients.email',
            'clients.phone',
            'clients.status',
            DB::raw('(SELECT appointments.date FROM appointments WHERE appointments.client_id = clients.id AND status = 2 ORDER BY appointments.date DESC LIMIT 1) as last_appointment_date'),
            DB::raw('(SELECT appointments.begin FROM appointments WHERE appointments.client_id = clients.id AND status = 2 ORDER BY appointments.date DESC LIMIT 1) as last_appointment_begin'),
            DB::raw('(SELECT COUNT(*) FROM appointments WHERE appointments.client_id = clients.id AND status = 2 ) as total_appointments'), 
            DB::raw('(SELECT sellings.detail FROM sellings WHERE sellings.appointment = (SELECT appointments.id FROM appointments WHERE appointments.client_id = clients.id ORDER BY appointments.date DESC LIMIT 1) ORDER BY sellings.created_at DESC LIMIT 1) as last_selling_detail')
        ])->paginate($perPage, ['*'], 'clients', $page);
         
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

        $log = new Log;

        $log->action = "delete_client";
        $log->detail = json_encode(["id" => $client->id,"name" => $client->name." ".$client->lastname]);
        $log->user = Auth::id();
        
        $log->save();

        return response()->json(["status" => 1, "clients" => $client]);
    }  

    public function recover(Request $request, $id){ 
        $client = Client::findOr($id, function () {
            return false;
        });

        if(!$client){
            return response()->json(["status" => 0, "message" => "Cliente no encontrado"]);
        }
        
        $client->status = 1;
        $client->save(); 

        $log = new Log;

        $log->action = "recover_client";
        $log->detail = json_encode(["id" => $client->id,"name" => $client->name ]);
        $log->user = Auth::id();
        
        $log->save();

        return response()->json(["status" => 1, "client" => $client]);
    } 
}

