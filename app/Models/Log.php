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
                return '<a href="'.URL::to('/').$routes['appointments']['edit']($detail->id).'" class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Creo cita <span class="font-bold">#'.$detail->identifier.'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'update_appointment':
                $detail = json_decode($log->detail);
                return '<a href="'.URL::to('/').$routes['appointments']['edit']($detail->id).'" class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Actualizo cita <span class="font-bold">#'.$detail->identifier.'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>'; 
            case 'delete_appointment':
                $detail = json_decode($log->detail);
                return '<a href="#" class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                                Elimino cita <span class="font-bold">#'.$detail->identifier.'</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">'.Controller::timeAgo($log->created_at).'</span>
                        </a>';  
        }
    }

    public static function getLogText($log){
        return self::generateLogTextFunction($log);
    }
}
