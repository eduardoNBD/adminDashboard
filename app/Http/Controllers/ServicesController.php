<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Service;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    public function create(Request $request){
        
        $validator = Validator::make(request()->all(), [
            'name' => 'required|unique:services',
            'key' => 'required|unique:services',
            'price' => 'required|numeric'
        ],
        [
            'name.required' => 'Campo <strong>Nombre de servicio</strong> requerido',
            'name.unique' => 'Ya existe un servicio con ese nombre', 
            'key.required' => 'Campo <strong>Clave</strong> requerido', 
            'key.unique' => 'Ya existe un servicio con esa clave', 
            'price.required' => 'Campo <strong>Precio</strong> requerido', 
            'price.numeric' => 'Campo <strong>Precio</strong> debe ser numero', 
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
           
        $service = new Service;
        
        $service->name   = $request->input("name");
        $service->key    = $request->input("key");
        $service->price  = $request->input("price");
        $service->modify_by = Auth::id();
        $service->save(); 
        
        return response()->json(["status" => 1, "message" => "Servicio guardado"]);
    } 

    public function update(Request $request, $id){
        
        $validator = Validator::make(request()->all(), [
            'name' => 'required|unique:services,name,'.$id,
            'key' => 'required|unique:services,key,'.$id,
            'price' => 'required|numeric'
        ],
        [
            'name.required' => 'Campo <strong>Nombre de servicio</strong> requerido',
            'name.unique' => 'Ya existe un servicio con ese nombre', 
            'key.required' => 'Campo <strong>Clave</strong> requerido', 
            'key.unique' => 'Ya existe un servicio con esa clave', 
            'price.required' => 'Campo <strong>Precio</strong> requerido', 
            'price.numeric' => 'Campo <strong>Precio</strong> debe ser numero', 
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

        $service = Service::findOr($id, function () {
            return false;
        });

        if(!$service){
            return response()->json(["status" => 0, "message" => "Servicio no encontrado"]);
        }

        if($service->status == 0)
        {
            return response()->json(["status" => 0, "message" => "Servicio Eliminado"]);
        }

        $service->name   = $request->input("name");
        $service->key    = $request->input("key");
        $service->price  = $request->input("price");
        $service->modify_by = Auth::id();
        $service->save(); 

        return response()->json(["status" => 1, "message" => "Servicio guardado " ]);
    }

    public function list(Request $request){ 
        $service = new Service;

        $services = $service->where("status",1);

        if($request->input("s"))
        {
            $services->where('name', 'like', $request->input("s") . '%')
                     ->orWhere('key', 'like', $request->input("s") . '%');
        }

        $perPage = 10; 
        $page = $request->input("page") ?: 1; 
    
        $totalServices = $services->count();

        $totalPages = ceil($totalServices / $perPage);

        $page = min($page, $totalPages);

        $services = $services->paginate($perPage, ['id', 'name', 'key', 'price'], 'services', $page);
         
        return response()->json(["status" => 1, 'services' => $services, 's' => $request->input("s")] );
    } 

    public function delete(Request $request, $id){ 
        $service = Service::findOr($id, function () {
            return false;
        });

        if(!$service){
            return response()->json(["status" => 0, "message" => "Servicio no encontrado"]);
        }
        
        $service->status = 0;
        $service->save(); 

        return response()->json(["status" => 1, "services" => $service]);
    }  
}

