<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogsController extends Controller
{
    public function getLogsByUser(Request $request, $id){
        $log = new Log;

        $logs = $log->where("logs.user",$id)->orderBy('created_at', 'desc');  

        $perPage = 5; 
        $page = $request->input("page") ?: 1; 
    
        $totalLogs = $logs->count();
        $totalPages = ceil($totalLogs / $perPage);

        $page = min($page, $totalPages);
        $fields = [
            'logs.id',
            'logs.action',
            'logs.detail', 
            'logs.created_at',
        ];
        
        $logs = $logs->paginate($perPage, $fields, 'logs', $page);
        
        foreach ($logs as $key => $log) {
           $logs[$key]->htmlAction  = str_replace('"',"'",Log::getLogText($logs[$key]));
        }
        
        return response()->json(["status" => 1, 'logs' => $logs ] );
    }
}