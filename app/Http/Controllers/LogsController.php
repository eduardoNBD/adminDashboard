<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogsController extends Controller
{
    public function list(Request $request){ 
        $logs = Log::leftJoin('users', 'users.id', '=', 'logs.user') 
                     ->orderBy('logs.created_at', 'desc');

        if(Auth::user()->role == "0"){
            $logs->where("user",Auth::id());
        }

        if($request->input("start") && $request->input("end")){
            $logs->whereBetween('logs.created_at', [$request->input('start'), $request->input('end')]);
        }

        $modules = $request->input("modules");

        $logs->where(function($query) use ($modules) {
            foreach ($modules as $keyword) {
                $query->orWhere('action', 'like', '%' . $keyword . '%');
            }
        });

        if($request->input("s")){
            $logs->where(function ($query) use ($request) {
                $query->where(DB::raw("CONCAT(users.name,' ',users.lastname)"), 'like', $request->input("s") . '%');
            });
        } 

        $perPage = 10; 
        $page = $request->input("page") ?: 1; 
    
        $totalLogs = $logs->count();
        $totalPages = ceil($totalLogs / $perPage);

        $page = min($page, $totalPages);
                
        $logsPaginator = $logs->paginate($perPage, [
            'action', 'logs.created_at', 'detail', 'logs.id','user', DB::raw("CONCAT(users.name, ' ', users.lastname) AS fullname")
        ], 'page', $page);
        
        $logs = $logsPaginator->getCollection()->map(function($log) {
            $log->detail = Log::getRelatedObject($log);
            return $log;
        });
    
        $logsPaginator->setCollection($logs);
         
        return response()->json(["status" => 1, 'logs' => $logsPaginator, 's' => $request->input("s")] );
    }

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