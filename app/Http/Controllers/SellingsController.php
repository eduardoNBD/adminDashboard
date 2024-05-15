<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Selling;
use App\Models\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SellingsController extends Controller
{
    public function create(Request $request){
        /*
        $rules = [  
            'date' => 'required|date|after_or_equal:'.date("Y-m-d"),
            'begin'  => 'required',
            'end'  => 'required|after:begin',  
        ];

        $textRules = [
            'date.required'  => "Campo <strong>fecha</strong> es requerido",
            'date.date'  => "Campo <strong>fecha</strong> debe ser una fecha valida",
            'date.after_or_equal'  => "Campo <strong>fecha</strong> debe ser una fecha actual o superior",
            'begin.required'  => "Campo <strong>hora de inicio</strong> es requerido",
            'end.required'  => "Campo <strong>hora de fin</strong> es requerido",
            'end.after'  => "Campo <strong>hora de fin</strong> debe ser superior a la hora de inicio",
        ];

        if($request->input("client")){  
            $rules['client'] = 'exists:clients,id';
            $textRules['client.exists'] = "Seleciona un cliente valido";
        }

        if($request->input("user")){  
            $rules['user'] = 'exists:users,id';
            $textRules['user.exists'] = "El usuario en <strong>Atendido por</strong> debe ser valido";
        }

        if($request->input("service")){
            $rules['service'] = 'exists:services,id';
            $textRules['service.exists'] = "Seleciona un servicio valido";
        }

        if($request->input("date") && $request->input("begin") ){
            $rules['dateTimeBegin'] = 'after_or_equal:'.date("Y-m-d H:i:s");
            $textRules['dateTimeBegin.after_or_equal'] = "La fecha y hora de inicio debe ser superior a la actual";
        }

        if($request->input("date") && $request->input("end") ){
            $rules['dateTimeEnd'] = 'after:dateTimeBegin';
            $textRules['dateTimeEnd.after'] = "La hora de fin debe ser superior a la hora de inicio";
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
        
        $latest = Appointment::latest()->first();

        if ($latest) {
            $latestId = $latest->identifier + 1; 
        } else {
            $latestId = 1;
        }

        $appointment = new Appointment;

        $appointment->user_id = $request->input("user");
        $appointment->modify_by  = Auth::id();
        $appointment->service_id  = $request->input("service");
        $appointment->client_id  = $request->input("client");
        $appointment->date = $request->input("date");       
        $appointment->begin = $request->input("begin");      
        $appointment->end = $request->input("end");        
        $appointment->notes = $request->input("notes");      
        $appointment->identifier = $latestId;

        $appointment->save();
        
        $log = new Log;

        $log->action = "create_appointment";
        $log->detail = json_encode(["id" => $appointment->id,"identifier" => $appointment->identifier]);
        $log->user = Auth::id();
        
        $log->save();*/
        
        return response()->json(["status" => 0, "message" => "Cita registrada"]);
    } 

    public function update(Request $request, $id){

        $rules = [  
            'date' => 'required|date|after_or_equal:'.date("Y-m-d"),
            'begin'  => 'required',
            'end'  => 'required|after:begin',  
        ];

        $textRules = [
            'date.required'  => "Campo <strong>fecha</strong> es requerido",
            'date.date'  => "Campo <strong>fecha</strong> debe ser una fecha valida",
            'date.after_or_equal'  => "Campo <strong>fecha</strong> debe ser una fecha actual o superior",
            'begin.required'  => "Campo <strong>hora de inicio</strong> es requerido",
            'end.required'  => "Campo <strong>hora de fin</strong> es requerido",
            'end.after'  => "Campo <strong>hora de fin</strong> debe ser superior a la hora de inicio",
        ];

        if($request->input("client")){  
            $rules['client'] = 'exists:clients,id';
            $textRules['client.exists'] = "Seleciona un cliente valido";
        }

        if($request->input("user")){  
            $rules['user'] = 'exists:users,id';
            $textRules['user.exists'] = "El usuario en <strong>Atendido por</strong> debe ser valido";
        }

        if($request->input("service")){
            $rules['service'] = 'exists:services,id';
            $textRules['service.exists'] = "Seleciona un servicio valido";
        }

        if($request->input("date") && $request->input("begin") ){
            $rules['dateTimeBegin'] = 'after_or_equal:'.date("Y-m-d H:i:s");
            $textRules['dateTimeBegin.after_or_equal'] = "La fecha y hora de inicio debe ser superior a la actual";
        }

        if($request->input("date") && $request->input("end") ){
            $rules['dateTimeEnd'] = 'after:dateTimeBegin';
            $textRules['dateTimeEnd.after'] = "La hora de fin debe ser superior a la hora de inicio";
        }

        $validator = Validator::make(request()->all(),$rules,$textRules);

        if ($validator->fails()){
            $messages = "";

            foreach ($validator->messages()->toArray() as $key => $errMessages) {
                foreach ($errMessages as $key => $errMessage) {
                    $messages.= $errMessage."<br>";
                }
                
            }

            return response()->json(["status" => 0, "message" => $messages.'--'.$id]);
        }

        $appointment = Appointment::findOr($id, function () {
            return false;
        });

        if(!$appointment){
            return response()->json(["status" => 0, "message" => "Cita no encontrado"]);
        }

        if($appointment->status == 0)
        {
            return response()->json(["status" => 0, "message" => "Cita Eliminado"]);
        }

        $prevData = [
            "user_id" => $appointment->user_id,
            "service_id" => $appointment->service_id,
            "client_id" => $appointment->client_id,
            "date" => $appointment->date,
            "begin" => $appointment->begin,
            "end" => $appointment->end,
            "notesnotes" => $appointment->user_id, 
        ];

        $appointment->user_id = $request->input("user");
        $appointment->modify_by  = Auth::id();
        $appointment->service_id  = $request->input("service");
        $appointment->client_id  = $request->input("client");
        $appointment->date = $request->input("date");       
        $appointment->begin = $request->input("begin");      
        $appointment->end = $request->input("end");        
        $appointment->notes = $request->input("notes");     

        $appointment->save();

        $newData = [
            "user_id" => $appointment->user_id,
            "service_id" => $appointment->service_id,
            "client_id" => $appointment->client_id,
            "date" => $appointment->date,
            "begin" => $appointment->begin,
            "end" => $appointment->end,
            "notesnotes" => $appointment->user_id, 
        ];

        $log = new Log;

        $log->action = "update_appointment";
        $log->detail = json_encode([
            "id" => $appointment->id,
            "identifier" => $appointment->identifier,
            "prevData" => $prevData,
            "newData" => $newData
        ]);
        $log->user = Auth::id();
        
        $log->save();

        return response()->json(["status" => 1, "message" => "CIta guardado " ]);
    }

    public function list(Request $request){ 
        $appointment = new Appointment;

        $appointments = $appointment->where("appointments.status",1)
                                    ->leftJoin('clients', 'clients.id', '=', 'appointments.client_id')
                                    ->leftJoin('services', 'services.id', '=', 'appointments.service_id')
        ;

        if($request->input("s"))
        {
            $appointments->where('identifier', 'like', $request->input("s") . '%')
                         ->orWhere(DB::raw("CONCAT(clients.name,' ',clients.lastname)"), 'like', $request->input("s") . '%');
        }

        $perPage = 10; 
        $page = $request->input("page") ?: 1; 
    
        $totalUsers = $appointments->count();
        $totalPages = ceil($totalUsers / $perPage);

        $page = min($page, $totalPages);
        $fields = [
            'appointments.id',
            'appointments.identifier',
            'appointments.date',
            'appointments.begin',
            'services.name as service_id',
            DB::raw("CONCAT(clients.name,' ',clients.lastname) AS client_id")
        ];
        
        $appointments = $appointments->paginate($perPage, $fields, 'appointments', $page);
         
        return response()->json(["status" => 1, 'appointments' => $appointments, 's' => $request->input("s")] );
    } 

    public function delete(Request $request, $id){ 
        $appointment = Appointment::findOr($id, function () {
            return false;
        });

        if(!$appointment){
            return response()->json(["status" => 0, "message" => "Cita no encontrada"]);
        }
        
        $appointment->status = 0;
        $appointment->save(); 

        $log = new Log;

        $log->action = "delete_appointment";
        $log->detail = json_encode(["id" => $appointment->id,"identifier" => $appointment->identifier]);
        $log->user = Auth::id();
        
        $log->save();

        return response()->json(["status" => 1, "appointment" => $appointment]);
    }  
}




    
           
                
                
                
                
                
                