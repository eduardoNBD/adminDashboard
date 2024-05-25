<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Service;
use App\Models\Product;
use App\Models\Client;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Log;
use App\Models\Selling;

class DashboardController extends Controller
{
    public function index(){
        $appointment = new Appointment;

        $appointments = $appointment->select([
                                'appointments.id',
                                'appointments.no',
                                'appointments.date',
                                'appointments.begin',
                                'appointments.status',
                                'services.name as service_id',
                                DB::raw("CONCAT(clients.name,' ',clients.lastname) AS client_id")
                            ])
                            ->where("appointments.status", 1)
                            ->where("appointments.date",">=",date("Y-m-d"));
        
        if(Auth::user()->role == "0" ){
            $appointments->where("appointments.user_id", Auth::id());
        }

        $appointments = $appointments->leftJoin('clients', 'clients.id', '=', 'appointments.client_id')
                            ->leftJoin('services', 'services.id', '=', 'appointments.service_id')->orderBy('date')->orderBy('begin')->take(5)->get();

        $appoToday = $appointment->select([DB::raw("COUNT(id) as total")])
                                    ->where("appointments.status","!=",0)
                                    ->where("appointments.date",date("Y-m-d"))->get()[0]->total;

        $appoPendi = $appointment->select([DB::raw("COUNT(id) as total")])
                                    ->where("appointments.status",1)
                                    ->where("appointments.date",date("Y-m-d"))->get()[0]->total;

        $appoFinis = $appointment->select([DB::raw("COUNT(id) as total")])
                                    ->where("appointments.status",2)
                                    ->where("appointments.date",date("Y-m-d"))->get()[0]->total;

        return view("dashboard.home", [ 
            'appointments' => $appointments,
            'appoToday' => $appoToday, 
            'appoPendi' => $appoPendi, 
            'appoFinis' => $appoFinis,  
            'chartValues' => Selling::getTotalSellings(),
            'profitsWeeks' => Selling::getTotalSellingsWeek(),
            'topProducts' => Selling::getTopProducts(),
        ]);
    }

    public function appointments($page = 1 ){
        return view("dashboard.appointments", [
            'page' => $page, 
            'status' => Appointment::getStatus(), 
            'services' => Service::get(),
            'products' => Product::get(),
        ]);
    }

    public function appointment($id = null){ 
        $title = $id ? "Actualizar Cita" : "Crear Cita";
        
        $appointment = new Appointment;
        $services = Service::where("status",1)->get();
        $clients = Client::select([DB::raw("CONCAT(name,' ',lastname) AS name"),"id"])->where("status",1)->get();
        $users = User::select([DB::raw("CONCAT(name,' ',lastname) AS name"),"id","role"])->where("status",1)->get();

        if($id)
        { 
            $appointment = Appointment::findOr($id, function () {
                return false;
            });
    
            if(!$appointment){
                return redirect('/dashboard/appointments');
            }
    
            if($appointment->status == 0){
                return redirect('/dashboard/appointments');
            }

            if(Auth::user()->role == "0" && $appointment->user_id != Auth::id() ){
                return redirect('/dashboard/appointments');
            }

            $title.=" ".$appointment->name;
        }

        return view("dashboard.appointment", [
            'title' => $title, 
            'appointment' => $appointment,
            'id' => $id,
            'services' => $services, 
            'clients' => $clients,
            'users' => $users,
        ]);
    }

    public function calendar($page = 1 ){
        return view("dashboard.calendar", [
            "colors" => Appointment::getColorsClass(),
            "status" => Appointment::getStatus(),
        ]);
    }

    public function clients($page = 1 ){
        return view("dashboard.clients", [
            'page' => $page, 
            'services' => Service::get(),
            'products' => Product::get(),
        ]);
    }

    public function client($id = null){ 
        $title = $id ? "Actualizar Cliente" : "Crear Cliente";
        $client = new Client;

        if($id)
        { 
            $client = Client::findOr($id, function () {
                return false;
            });
    
            if(!$client){
                return redirect('/dashboard/clients');
            }
    
            if($client->status == 0){
                return redirect('/dashboard/clients');
            }

            $title.=" ".$client->name;
        }

        return view("dashboard.client", [
            'title' => $title, 
            'client' => $client,
            'id' => $id,
        ]);
    }

    public function products($page = 1 ){
        return view("dashboard.products", [
            'page' => $page, 
        ]);
    }

    public function product($id = null){ 
        $title   = $id ? "Actualizar Producto" : "Crear Producto";
        $product = new Product;

        if($id)
        { 
            $product = Product::findOr($id, function () {
                return false;
            });
    
            if(!$product){
                return redirect('/dashboard/products');
            }
    
            if($product->status == 0){
                return redirect('/dashboard/products');
            }

            $title.=" ".$product->name;
        }

        return view("dashboard.product", [
            'title' => $title, 
            'product' => $product,
            'id' => $id,
        ]);
    }

    public function services($page = 1 ){
        return view("dashboard.services", [
            'page' => $page,  
        ]);
    }

    public function service($id = null){ 
        $title   = $id ? "Actualizar Servicio" : "Crear Service";
        $service = new Service;

        if($id)
        { 
            $service = Service::findOr($id, function () {
                return false;
            });
    
            if(!$service){
                return redirect('/dashboard/services');
            }
    
            if($service->status == 0){
                return redirect('/dashboard/services');
            }

            $title.=" ".$service->name; 
        }
 
        return view("dashboard.service", [
            'title' => $title, 
            'service' => $service,
            'id' => $id,
        ]);
    }

    public function sellings($page = 1 ){
        return view("dashboard.sellings", [
            'page' => $page, 
            'status' => Selling::getStatus(), 
            'services' => Service::get(),
            'products' => Product::get(),
        ]);
    }

    public function selling($id = null){ 
        $title = $id ? "Actualizar Venta" : "Crear Venta";
        $selling = new Selling;
        $services = Service::whereIn("status",$id ? [0,1] : [1])->get();
        $products = Product::whereIn("status",$id ? [0,1] : [1])->get();
        $clients = Client::select([DB::raw("CONCAT(name,' ',lastname) AS name"),"id"])->whereIn("status",$id ? [0,1] : [1])->get();
        $users = User::select([DB::raw("CONCAT(name,' ',lastname) AS name"),"id", "role"])->whereIn("status",$id ? [0,1] : [1])->get();
        $appointments = Appointment::select([DB::raw("CONCAT('#',no) as name"),
                                            'appointments.id', 
                                            'appointments.date',
                                            'appointments.begin',
                                            'appointments.service_id',
                                            'appointments.client_id',
                                            'appointments.user_id',
                                            'appointments.notes',])
                                    ->where("appointments.status",[1,2])
                                    ->where("appointments.date",">=",date("Y-m-d"))
                                    ->leftJoin('clients', 'clients.id', '=', 'appointments.client_id')
                                    ->leftJoin('services', 'services.id', '=', 'appointments.service_id'); 
                                    

         if($id){ 
            $selling = Selling::findOr($id, function () {
                return false;
            });
    
            if(!$selling){
                return redirect('/dashboard/sellings');
            }
    
            if($selling->status == 0 || $selling->status == 2){
                return redirect('/dashboard/sellings');
            }

            $title.=" #".$selling->no;

            $appointments->orWhere("appointments.id",$selling->appointment); 
        } 

        $appointments = $appointments->get();

        return view("dashboard.selling", [
            'title' => $title, 
            'services' => $services,
            'products' => $products,
            'clients' => $clients,
            'users' => $users,
            'appointments' => $appointments,
            'id' => $id,
            'selling' => $selling,  
        ]);
    }

    public function invoice($id){  
        $selling = new Selling;
        $services = Service::get();
        $products = Product::get();
        $clients = Client::select([DB::raw("CONCAT(name,' ',lastname) AS name"),"id"])->get();
        $users = User::select([DB::raw("CONCAT(name,' ',lastname) AS name"),"id", "role"])->get();
        $appointments = Appointment::select([DB::raw("CONCAT('#',no) as name"),
                                            'appointments.id', 
                                            'appointments.date',
                                            'appointments.begin',
                                            'appointments.service_id',
                                            'appointments.client_id',
                                            'appointments.user_id',
                                            'appointments.notes',])
                                    ->where("appointments.status",[1,2])
                                    ->where("appointments.date",">=",date("Y-m-d"))
                                    ->leftJoin('clients', 'clients.id', '=', 'appointments.client_id')
                                    ->leftJoin('services', 'services.id', '=', 'appointments.service_id'); 
                                    

         if($id){ 
            $selling = Selling::findOr($id, function () {
                return false;
            });
    
            if(!$selling){
                return redirect('/dashboard/sellings');
            }
    
            if($selling->status != 2){
                return redirect('/dashboard/sellings');
            }

            $title = "Recibo de venta #".$selling->no;
            $appointments->orWhere("appointments.id",$selling->appointment); 
        } 

        $appointments = $appointments->get();

        return view("dashboard.invoice", [
            'title' => $title, 
            'services' => $services,
            'products' => $products,
            'clients' => $clients,
            'users' => $users,
            'appointments' => $appointments,
            'id' => $id,
            'selling' => $selling,  
        ]);
    }

    public function users($page = 1 ){
        return view("dashboard.users", [
            'page' => $page, 
            'roles' => User::getRoles(),
        ]);
    }

    public function user($id = null){ 
        $title = $id ? "Actualizar Usuario" : "Crear Usuario";
        $user = new User;

        if($id)
        { 
            $user = User::findOr($id, function () {
                return false;
            });
    
            if(!$user){
                return redirect('/dashboard/users');
            }
    
            if($user->status == 0){
                return redirect('/dashboard/users');
            }

            $title.=" ".$user->name;
        }

        return view("dashboard.user", [
            'title' => $title, 
            'user' => $user,
            'id' => $id,
            'roles' => User::getRoles(),
        ]);
    }

    public function profile(){ 
        
        return view("dashboard.profile", [
            'user' => Auth::user(), 
            'roles' => User::getRoles(),
            'logs' => Log::where("user",Auth::user()->id)->orderBy('created_at', 'desc')->take(5)->get(),
        ]);
    }

    public function userDetail($id){
        
        $user = User::findOr($id, function () {
            return false;
        });

        if(!$user){
            return redirect('/dashboard/users');
        }

        if($user->status == 0){
            return redirect('/dashboard/users');
        }

        $sellings = Selling::getTotalSellingsMonthsByUser($id);
        
        for ($i=0; $i < count($sellings); $i++) { 
            $sellings[$i]->month = self::$monthsNamesEsp[intval($sellings[$i]->month)-1];
        }
         
        $user->role = User::getRoles($user->role);

        return view("dashboard.userDetail", [
            'user' => $user,   
            'sellings' =>  $sellings, 
        ]);
    }

    public function logs($page = 1 ){
        return view("dashboard.logs", [
            'page' => $page, 
        ]);
    }
}
