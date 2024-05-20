<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Selling;
use App\Models\Log;
use App\Models\Appointment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule; 

class SellingsController extends Controller
{
    public function create(Request $request){
        
        $rules = [  
            'type.*' => 'required|in:Servicios,Productos', 
            'price.*' => 'required|numeric',
            'qty.*' => 'required|integer|min:1',
            'users.*' => 'required|exists:users,id',
        ];

        $textRules = [
            'type.*.required' => 'El campo <strong>tipo</strong> es obligatorio.',
            'type.*.in' => 'El <strong>tipo</strong> debe ser Servicios o Productos.', 
            'price.*.required' => 'El campo <strong>precio</strong> es obligatorio.',
            'price.*.numeric' => 'El <strong>precio</strong> debe ser un número.', 
            'qty.*.required' => 'El campo <strong>cantidad</strong> es obligatorio.',
            'qty.*.integer' => 'La <strong>cantidad</strong> debe ser un número entero.',
            'qty.*.min' => 'La <strong>cantidad</strong> debe ser mayor o igual a 1.', 
        ];

        if(is_array($request->input("items"))){
            foreach ($request->input("users") as $key => $value) {
                $rules["users.{$key}"] = "required|exists:users,id";
                $textRules["users.{$key}.required"] = 'El campo <strong>usuario</strong> en la fila <strong>'.($key+1).'</strong> es requerido';
                $textRules["users.{$key}.exists"] = 'El campo <strong>usuario</strong> en la fila <strong>'.($key+1).'</strong> debe ser un usuario valido';
        
            }

            foreach ($request->input("items") as $key => $value) {
                $rules["items.{$key}"] = [
                    'required',
                    Rule::exists($request->input("type")[$key] == 'Servicios' ? 'services' : 'products', 'id')
                ];

                $textRules["items.{$key}.required"] = $request->input("type")[$key] == 'Servicios' ? 'El campo <strong>servicio</strong> en la fila <strong>'.($key+1).'</strong> es requerido' : 'El campo <strong>producto</strong> en la fila <strong>'.($key+1).'</strong> es requerido';
                $textRules["items.{$key}.exists"] = $request->input("type")[$key] == 'Servicios' ? 'El campo <strong>servicio</strong> en la fila <strong>'.($key+1).'</strong> debe ser un servicio valido' : 'El campo <strong>producto</strong> en la fila <strong>'.($key+1).'</strong> debe ser un producto valido';
            }
        }else{
            return response()->json(["status" => 0, "message" => "Es necesario agregar servicios o productos"]);
        }
        

        if($request->input("clients")){  
            $rules['clients'] = 'exists:clients,id';
            $textRules['clients.exists'] = "Seleciona un cliente valido";
        }

        if($request->input("appointment")){  
            $rules['appointment'] = 'exists:appointments,id';
            $textRules['appointment.exists'] = "Seleciona un cita valida";
        }

        $validator = Validator::make(request()->all(),$rules,$textRules);

        if ($validator->fails()){
            $messages = "";

            foreach ($validator->messages()->toArray() as $key => $errMessages) {
                foreach ($errMessages as $key => $errMessage) {
                    $messages.= $errMessage."<br>";
                }
                
            }

            return response()->json(["status" => 0, "message" => $messages]);
        }  
        
        $appointment = Appointment::findOr($request->input("appointment"), function () {
            return false;
        });

        if(!$appointment){
            return response()->json(["status" => 0, "message" => "Cita no encontrado"]);
        }

        if($appointment->status == 0 || $appointment->status == 2)
        {
            return response()->json(["status" => 0, "message" => "Cita Cancelada o ya se cobro"]);
        }
        
        $latest = Selling::latest()->first();

        if ($latest) {
            $latestId = $latest->no + 1; 
        } else {
            $latestId = 1;
        }

        $selling = new Selling;
        
        $selling->subtotal = $request->input("subtotal");
        $selling->notes    = $request->input("notes");
        $selling->status   = $request->input("status");
        $selling->detail   = json_encode([
            "types" => $request->input("type"),
            "items" => $request->input("items"),
            "price" => $request->input("price"),
            "qty" => $request->input("qty"),
            "users" => $request->input("users"),
        ]);
         
        $selling->appointment = $appointment->id;
        $selling->client = $request->input("clients");
        $selling->no     = $latestId;
        $selling->modify_by = Auth::id();
        $selling->save(); 
        
        if($request->input("status") == 2){
            $appointment->status = 2;
            $appointment->save();
        }

        $log = new Log;

        $log->action = "create_selling";
        $log->detail = json_encode(["id" => $selling->id, "name" => $selling->no, "appointment" => $appointment->no]);
        $log->user = Auth::id();
        
        $log->save();

        return response()->json(["status" => 1, "message" => "Venta guardado"]);
    } 

    public function update(Request $request, $id){
        
        $rules = [  
            'type.*' => 'required|in:Servicios,Productos', 
            'price.*' => 'required|numeric',
            'qty.*' => 'required|integer|min:1',
            'users.*' => 'required|exists:users,id',
        ];

        $textRules = [
            'type.*.required' => 'El campo <strong>tipo</strong> es obligatorio.',
            'type.*.in' => 'El <strong>tipo</strong> debe ser Servicios o Productos.', 
            'price.*.required' => 'El campo <strong>precio</strong> es obligatorio.',
            'price.*.numeric' => 'El <strong>precio</strong> debe ser un número.', 
            'qty.*.required' => 'El campo <strong>cantidad</strong> es obligatorio.',
            'qty.*.integer' => 'La <strong>cantidad</strong> debe ser un número entero.',
            'qty.*.min' => 'La <strong>cantidad</strong> debe ser mayor o igual a 1.', 
        ];

        if(is_array($request->input("items"))){
            foreach ($request->input("users") as $key => $value) {
                $rules["users.{$key}"] = "required|exists:users,id";
                $textRules["users.{$key}.required"] = 'El campo <strong>usuario</strong> en la fila <strong>'.($key+1).'</strong> es requerido';
                $textRules["users.{$key}.exists"] = 'El campo <strong>usuario</strong> en la fila <strong>'.($key+1).'</strong> debe ser un usuario valido';
        
            }

            foreach ($request->input("items") as $key => $value) {
                $rules["items.{$key}"] = [
                    'required',
                    Rule::exists($request->input("type")[$key] == 'Servicios' ? 'services' : 'products', 'id')
                ];

                $textRules["items.{$key}.required"] = $request->input("type")[$key] == 'Servicios' ? 'El campo <strong>servicio</strong> en la fila <strong>'.($key+1).'</strong> es requerido' : 'El campo <strong>producto</strong> en la fila <strong>'.($key+1).'</strong> es requerido';
                $textRules["items.{$key}.exists"] = $request->input("type")[$key] == 'Servicios' ? 'El campo <strong>servicio</strong> en la fila <strong>'.($key+1).'</strong> debe ser un servicio valido' : 'El campo <strong>producto</strong> en la fila <strong>'.($key+1).'</strong> debe ser un producto valido';
            }
        }else{
            return response()->json(["status" => 0, "message" => "Es necesario agregar servicios o productos"]);
        }
        

        if($request->input("clients")){  
            $rules['clients'] = 'exists:clients,id';
            $textRules['clients.exists'] = "Seleciona un cliente valido";
        }

        if($request->input("appointment")){  
            $rules['appointment'] = 'exists:appointments,id';
            $textRules['appointment.exists'] = "Seleciona un cita valida";
        }

        $validator = Validator::make(request()->all(),$rules,$textRules);

        if ($validator->fails()){
            $messages = "";

            foreach ($validator->messages()->toArray() as $key => $errMessages) {
                foreach ($errMessages as $key => $errMessage) {
                    $messages.= $errMessage."<br>";
                }
                
            }

            return response()->json(["status" => 0, "message" => $messages]);
        }  

        $selling = Selling::findOr($id, function () {
            return false;
        });

        if(!$selling){
            return response()->json(["status" => 0, "message" => "Producto no encontrado"]);
        }

        if($selling->status == 0)
        {
            return response()->json(["status" => 0, "message" => "Producto Eliminado"]);
        }
 
        $appointment = Appointment::findOr($request->input("appointment"), function () {
            return false;
        });

        if(!$appointment){
            return response()->json(["status" => 0, "message" => "Cita no encontrado"]);
        }

        if($appointment->status == 0  )
        {
            return response()->json(["status" => 0, "message" => "Cita Cancelada o ya se cobro"]);
        }

        $prevData = [
            "subtotal" => $selling->subtotal, 
            "notes" => $selling->notes, 
            "status" => $selling->status, 
            "detail" => $selling->detail, 
            "appointment" => $selling->appointment, 
            "client" => $selling->client,  
        ];
        
        $selling->subtotal = $request->input("subtotal");
        $selling->notes    = $request->input("notes");
        $selling->status   = $request->input("status");
        $selling->detail   = json_encode([
            "types" => $request->input("type"),
            "items" => $request->input("items"),
            "price" => $request->input("price"),
            "qty" => $request->input("qty"),
            "users" => $request->input("users"),
        ]);
         
        $selling->appointment = $appointment->id;
        $selling->client = $request->input("clients"); 
        $selling->modify_by = Auth::id();
        $selling->save(); 
        
        if($request->input("status") == 2){
            $appointment->status = 2;
            $appointment->save();
        }

        $newData = [
            "subtotal" => $selling->subtotal, 
            "notes" => $selling->notes, 
            "status" => $selling->status, 
            "detail" => $selling->detail, 
            "appointment" => $selling->appointment, 
            "client" => $selling->client,  
        ];

        $log = new Log;

        $log->action = "update_selling";
        $log->detail = json_encode([
            "id" => $selling->id,
            "name" =>  $selling->no,
            "prevData" => $prevData,
            "newData" => $newData,
            "appointment" => $appointment->no
        ]);

        $log->user = Auth::id();
        
        $log->save();

        return response()->json(["status" => 1, "message" => "Producto guardado " ]);
    }

    public function list(Request $request){ 
        $selling = new Selling;

        $sellings = $selling->whereIn("sellings.status",[1,2])
                                    ->leftJoin('clients', 'clients.id', '=', 'sellings.client')
                                    ->leftJoin('appointments', 'appointments.id', '=', 'sellings.appointment')
        ;

        if($request->input("s"))
        { 
            $sellings->where(function ($query) use ($request) {
                $query->where('sellings.no', 'like', $request->input("s") . '%')
                      ->orWhere(DB::raw("CONCAT(clients.name,' ',clients.lastname)"), 'like', $request->input("s") . '%');
            });
        }

        $perPage = 10; 
        $page = $request->input("page") ?: 1; 
    
        $totalUsers = $sellings->count();
        $totalPages = ceil($totalUsers / $perPage);

        $page = min($page, $totalPages);
         
        $fields = [
            'sellings.id',
            'sellings.no',
            'sellings.subtotal', 
            DB::raw('sellings.updated_at as updated_at'), 
            'sellings.status',
            'sellings.client as client_id', 
            'appointments.no as appointments',
            DB::raw("CONCAT(clients.name,' ',clients.lastname) AS client")
        ];
        
        $sellings = $sellings->paginate($perPage, $fields, 'sellings', $page);
 
        return response()->json(["status" => 1, 'sellings' => $sellings, 's' => $request->input("s")] );
    } 

    public function delete(Request $request, $id){ 
        $selling = Selling::findOr($id, function () {
            return false;
        });
         
        if(!$selling){
            return response()->json(["status" => 0, "message" => "Producto no encontrado"]);
        }
        
        $selling->status = 0;
        $selling->save(); 

        $log = new Log;

        $log->action = "delete_product";
        $log->detail = json_encode(["id" => $selling->id,"name" => $selling->no ]);
        $log->user = Auth::id();
        
        $log->save();

        return response()->json(["status" => 1, "product" => $selling]);
    } 
}




    
           
                
                
                
              
                
