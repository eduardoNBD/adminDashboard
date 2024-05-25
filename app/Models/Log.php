<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    Service,
    Product,
    Client,
    User,
    Appointment,
    Log,
    Selling,
};

class Log extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'logs';
    public $keyType  = 'string';
    public $incrementing = false; 
    const UPDATED_AT = null;    

    public static function generateLogTextFunction($log) {
        require getcwd()."/../config/menu.php";

        switch ($log->action) {
            case 'create_appointment':
                $detail = json_decode($log->detail);
                return '<a href="'.URL::to('/').$routes['appointments']['edit']($detail->id).'" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                            Creo cita <span class="font-bold">#'.$detail->name.'</span>
                            <br/>
                            <span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'update_appointment':
                $detail = json_decode($log->detail);
                return '<a href="'.URL::to('/').$routes['appointments']['edit']($detail->id).'" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Actualizo cita <span class="font-bold">#'.$detail->name.'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'delete_appointment':
                $detail = json_decode($log->detail);
                return '<a href="#" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Cancelo cita <span class="font-bold">#'.$detail->name.'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>';
            case 'create_client':
                $detail = json_decode($log->detail);
                return '<a href="'.URL::to('/').$routes['clients']['edit']($detail->id).'" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                            Creo cliente <span class="font-bold">'.$detail->name.'</span>
                            <br/>
                            <span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'update_client':
                $detail = json_decode($log->detail);
                return '<a href="'.URL::to('/').$routes['clients']['edit']($detail->id).'" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Actualizo cliente <span class="font-bold">'.$detail->name.'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'delete_client':
                $detail = json_decode($log->detail);
                return '<a href="#" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Elimino cliente <span class="font-bold">'.$detail->name.'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>';  
            case 'recover_client':
                $detail = json_decode($log->detail);
                return '<a href="'.URL::to('/').$routes['clients']['edit']($detail->id).'" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Se habilito cliente Eliminado <span class="font-bold">'.$detail->name.'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'create_product':
                $detail = json_decode($log->detail);
                return '<a href="'.URL::to('/').$routes['products']['edit']($detail->id).'" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                            Creo producto <span class="font-bold">'.$detail->name.'</span>
                            <br/>
                            <span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'update_product':
                $detail = json_decode($log->detail);
                return '<a href="'.URL::to('/').$routes['products']['edit']($detail->id).'" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Actualizo producto <span class="font-bold">'.$detail->name.'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'delete_product':
                $detail = json_decode($log->detail);
                return '<a href="#" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Elimino producto <span class="font-bold">'.$detail->name.'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'recover_product':
                $detail = json_decode($log->detail);
                return '<a href="'.URL::to('/').$routes['products']['edit']($detail->id).'" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Se habilito producto Eliminado <span class="font-bold">'.$detail->name.'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'create_service':
                $detail = json_decode($log->detail);
                return '<a href="'.URL::to('/').$routes['services']['edit']($detail->id).'" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                            Creo servicio <span class="font-bold">'.$detail->name.'</span>
                            <br/>
                            <span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'update_service':
                $detail = json_decode($log->detail);
                return '<a href="'.URL::to('/').$routes['services']['edit']($detail->id).'" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Actualizo servicio <span class="font-bold">'.$detail->name.'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'delete_service':
                $detail = json_decode($log->detail);
                return '<a href="#" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Elimino servicio <span class="font-bold">'.$detail->name.'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>';  
            case 'recover_service':
                $detail = json_decode($log->detail);
                return '<a href="'.URL::to('/').$routes['services']['edit']($detail->id).'" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Se habilito servicio Eliminado  <span class="font-bold">'.$detail->name.'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'create_selling':
                $detail = json_decode($log->detail);
                return '<a href="'.URL::to('/').$routes['sellings']['edit']($detail->id).'" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                            Creo venta <span class="font-bold">#'.$detail->name.' '.(property_exists($detail,"appointment") ? "con la cita #".$detail->appointment : "").'</span>
                            <br/>
                            <span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'update_selling':
                $detail = json_decode($log->detail);
                return '<a href="'.URL::to('/').$routes['sellings']['edit']($detail->id).'" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Actualizo venta <span class="font-bold">#'.$detail->name.' '.(property_exists($detail,"appointment") ? "con la cita #".$detail->appointment : "").'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'delete_selling':
                $detail = json_decode($log->detail);
                return '<a href="#" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Elimino venta <span class="font-bold">#'.$detail->name.' '.(property_exists($detail,"appointment") ? "con la cita #".$detail->appointment : "").'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'update_profile':
                return '<a href="#" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Actualizo perfil
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'update_password':
                return '<a href="#" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Cambio de contraseña
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'create_user':
                $detail = json_decode($log->detail);
                return '<a href="'.URL::to('/').$routes['users']['edit']($detail->id).'" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                            Creo usuario <span class="font-bold">'.$detail->name.'</span>
                            <br/>
                            <span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'update_user':
                $detail = json_decode($log->detail);
                return '<a href="'.URL::to('/').$routes['users']['edit']($detail->id).'" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Actualizo usuario <span class="font-bold">'.$detail->name.'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'update_password_for_user':
                $detail = json_decode($log->detail);
                return '<a href="'.URL::to('/').$routes['users']['edit']($detail->id).'" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Actualizo contraseña de usuario <span class="font-bold">'.$detail->name.'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'delete_user':
                $detail = json_decode($log->detail);
                return '<a href="#" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Elimino usuario <span class="font-bold">'.$detail->name.'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>';  
            case 'recover_user':
                $detail = json_decode($log->detail);
                return '<a href="'.URL::to('/').$routes['users']['edit']($detail->id).'" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                            Se habilito usuario Eliminado <span class="font-bold">'.$detail->name.'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 

            default:
                return $log->action;
        }
    }

    public static function getLogText($log){
        return self::generateLogTextFunction($log);
    }

    public static function getRelatedObject($log) { 
        $actions = [
            'create_appointment' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Creaste cita" : "Creo cita";
                return $detail;
            },
            'update_appointment' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Actualizaste cita" : "Actualizo cita"; 

                $detail->prevData->user_id = User::find($detail->prevData->user_id);
                $detail->prevData->client_id = Client::find($detail->prevData->client_id);
                $detail->prevData->service_id = Service::find($detail->prevData->service_id);
                $detail->newData->user_id = $detail->newData->user_id == $detail->prevData->user_id ? $detail->prevData->user_id : User::find($detail->newData->user_id);
                $detail->newData->client_id = $detail->newData->client_id == $detail->prevData->client_id ? $detail->prevData->client_id : Client::find($detail->newData->client_id);
                $detail->newData->service_id = $detail->newData->service_id == $detail->prevData->service_id ? $detail->prevData->service_id : Service::find($detail->newData->service_id);
                
                return $detail;
            },
            'delete_appointment' => function ($detail, $isOwn) {   
                $detail->actionName = $isOwn ? "Eliminaste cita" : "Elimino cita";
                return $detail;
            },
            'create_client' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Creaste cliente" : "Creo cliente";
                return $detail;
            },
            'update_client' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Actualizaste cliente" : "Actualizo cliente";
                return $detail;
            },
            'delete_client' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Eliminaste cliente" : "Elimino cliente";
                return $detail;
            },
            'recover_client' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Recuperaste cliente" : "Recupero cliente";
                return $detail;
            },
            'create_product' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Creaste producto" : "Creo producto";
                return $detail;
            },
            'update_product' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Actualizaste producto" : "Actualizo producto";
                return $detail;
            },
            'delete_product' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Eliminaste producto" : "Elimino producto";
                return $detail;
            },
            'recover_product' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Recuperaste producto" : "Recupero producto";
                return $detail;
            },
            'create_service' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Creaste servicio" : "Creo servicio";
                return $detail;
            },
            'update_service' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Actualizaste servicio" : "Actualizo servicio";
                return $detail;
            },
            'delete_service' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Eliminaste servicio" : "Elimino servicio";
                return $detail;
            }, 
            'recover_service' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Recuperaste servicio" : "Recupero servicio";
                return $detail;
            },
            'create_selling' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Creaste venta" : "Creo venta";
                return $detail;
            },
            'update_selling' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Actualizaste venta" : "Actualizo venta";
                $detail->prevData->clientObj = Client::find($detail->prevData->client);
                $detail->prevData->appointmentObj = Appointment::find($detail->prevData->appointment);

                $detail->prevData->detail = json_decode($detail->prevData->detail);
                $detail->newData->detail = json_decode($detail->newData->detail);

                foreach ($detail->prevData->detail->types as $key => $value) {
                    if($value == "Servicios"){
                        $detail->prevData->detail->items[$key] = Service::find($detail->prevData->detail->items[$key]);
                    }else{
                        $detail->prevData->detail->items[$key] = Product::find($detail->prevData->detail->items[$key]);
                    }
                    
                    $detail->prevData->detail->users[$key] = User::find($detail->prevData->detail->users[$key]);
                }

                foreach ($detail->newData->detail->types as $key => $value) {
                    if($value == "Servicios"){
                        $detail->newData->detail->items[$key] = Service::find($detail->newData->detail->items[$key]);
                    }else{
                        $detail->newData->detail->items[$key] = Product::find($detail->newData->detail->items[$key]);
                    }
                    
                    $detail->newData->detail->users[$key] = User::find($detail->newData->detail->users[$key]);
                }

                return $detail;
            },
            'delete_selling' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Eliminaste venta" : "Elimino venta";
                return $detail;
            },
            'update_profile' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Actualizaste tu perfil" : "Actualizo su perfil";
                return $detail;
            },
            'update_password' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Cambiaste tu contraseña" : "Cambio su contraseña";
                return $detail;
            },
            'create_user' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "creaste un usuario" : "Creo usuario";
                return $detail;
            },
            'update_user' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Actualisaste usuario" : "Actualizo usuario";
                return $detail;
            },
            'update_password_for_user' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Cambiaste contraseña usuario" : "Cambio contraseña usuario";
                return $detail;
            },
            'delete_user' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Eliminaste usuario" : "Elimino usuario";
                return $detail;
            },
            'recover_user' => function ($detail, $isOwn) {
                $detail->actionName = $isOwn ? "Recuperaste usuario" : "Recupero usuario";
                return $detail;
            }, 
        ];

        $isOwn = $log->user == Auth::id();
        $detail = json_decode($log->detail);
        $action = $log->action;
        
        if (isset($actions[$action])) {
            return $actions[$action]($detail, $isOwn);
        }

        return $detail;
    }
}
