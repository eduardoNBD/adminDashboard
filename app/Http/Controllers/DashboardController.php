<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\Product;
use App\Models\Client;
use App\Models\User;
use App\Models\Appointment;

class DashboardController extends Controller
{
    public function index(){
        return view("dashboard.home");
    }

    public function appointments($page = 1 ){
        return view("dashboard.appointments", [
            'page' => $page, 
        ]);
    }

    public function appointment($id = null){ 
        $title = $id ? "Actualizar Cita" : "Crear Cita";
        
        $appointment = new Appointment;
        $services = Service::where("status",1)->get();
        $clients = Client::select([DB::raw("CONCAT(name,' ',lastname) AS name"),"id"])->where("status",1)->get();
        $users = User::select([DB::raw("CONCAT(name,' ',lastname) AS name"),"id"])->where("status",1)->where("role",0)->get();

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

    public function clients($page = 1 ){
        return view("dashboard.clients", [
            'page' => $page, 
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
        ]);
    }

    public function selling($id = null){ 
        $title = $id ? "Actualizar Venta" : "Crear Venta";
        
        $services = Service::where("status",1)->get();
        $products = Product::where("status",1)->get();
        $clients = Client::select([DB::raw("CONCAT(name,' ',lastname) AS name"),"id"])->where("status",1)->get();
        $users = User::select([DB::raw("CONCAT(name,' ',lastname) AS name"),"id"])->where("status",1)->get();

        return view("dashboard.selling", [
            'title' => $title, 
            'services' => $services,
            'products' => $products,
            'clients' => $clients,
            'users' => $users,
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
        ]);
    }
}
