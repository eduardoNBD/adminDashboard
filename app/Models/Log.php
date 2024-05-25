<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

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
                            Creo cita <span class="font-bold">#'.$detail->no.'</span>
                            <br/>
                            <span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'update_appointment':
                $detail = json_decode($log->detail);
                return '<a href="'.URL::to('/').$routes['appointments']['edit']($detail->id).'" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Actualizo cita <span class="font-bold">#'.$detail->no.'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'delete_appointment':
                $detail = json_decode($log->detail);
                return '<a href="#" class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Cancelo cita <span class="font-bold">#'.$detail->no.'</span>
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
}
