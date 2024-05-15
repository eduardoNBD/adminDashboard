<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\SellingsController;
use App\Http\Middleware\Authenticate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|  
*/

Route::get("/",[LoginController::class,"Login"]);
Route::get("/login",[LoginController::class,"Login"]); 
Route::get("/logout",[LoginController::class,"Logout"]); 
Route::post('/login', [ 'as' => 'login', 'uses' => 'LoginController@Login']);
Route::get("/dashboard",[DashboardController::class,"index"])->middleware('auth');

//ROUTES Appointments
Route::get("/dashboard/appointments",[DashboardController::class,"appointments"])->middleware('auth');
Route::get("/dashboard/appointments/{page}",[DashboardController::class,"appointments"])->middleware('auth')->where('page', '[0-9]+');
Route::get("/dashboard/appointments/appointment/",[DashboardController::class,"appointment"])->middleware('auth');
Route::get("/dashboard/appointments/appointment/{id}",[DashboardController::class,"appointment"])->middleware('auth')->where('id', '[a-z0-9.\-]+');

//ROUTES Clients
Route::get("/dashboard/clients",[DashboardController::class,"clients"])->middleware('auth');
Route::get("/dashboard/clients/{page}",[DashboardController::class,"clients"])->middleware('auth')->where('page', '[0-9]+');
Route::get("/dashboard/clients/client",[DashboardController::class,"client"])->middleware('auth');
Route::get("/dashboard/clients/client/{id}",[DashboardController::class,"client"])->middleware('auth')->where('id', '[a-z0-9.\-]+');

//ROUTES Products
Route::get("/dashboard/products",[DashboardController::class,"products"])->middleware('auth');
Route::get("/dashboard/products/{page}",[DashboardController::class,"products"])->middleware('auth')->where('page', '[0-9]+');
Route::get("/dashboard/products/product",[DashboardController::class,"product"])->middleware('auth');
Route::get("/dashboard/products/product/{id}",[DashboardController::class,"product"])->middleware('auth')->where('id', '[a-z0-9.\-]+');

//ROUTES Services
Route::get("/dashboard/services",[DashboardController::class,"services"])->middleware('auth');
Route::get("/dashboard/services/{page}",[DashboardController::class,"services"])->middleware('auth')->where('page', '[0-9]+');
Route::get("/dashboard/services/service",[DashboardController::class,"service"])->middleware('auth');
Route::get("/dashboard/services/service/{id}",[DashboardController::class,"service"])->middleware('auth')->where('id', '[a-z0-9.\-]+');

//ROUTES Sellings
Route::get("/dashboard/sellings",[DashboardController::class,"sellings"])->middleware('auth');
Route::get("/dashboard/sellings/{page}",[DashboardController::class,"sellings"])->middleware('auth')->where('page', '[0-9]+');
Route::get("/dashboard/sellings/selling",[DashboardController::class,"selling"])->middleware('auth');
Route::get("/dashboard/sellings/selling/{id}",[DashboardController::class,"selling"])->middleware('auth')->where('id', '[a-z0-9.\-]+');

//ROUTES Users
Route::get("/dashboard/users",[DashboardController::class,"users"])->middleware('auth');
Route::get("/dashboard/users/{page}",[DashboardController::class,"users"])->middleware('auth')->where('page', '[0-9]+');
Route::get("/dashboard/users/user",[DashboardController::class,"user"])->middleware('auth');
Route::get("/dashboard/users/user/{id}",[DashboardController::class,"user"])->middleware('auth')->where('id', '[a-z0-9.\-]+');
Route::get("/dashboard/profile",[DashboardController::class,"profile"])->middleware('auth');

//ENDPOINTS AUTH
Route::post("/auth/login",[LoginController::class,"LoginRequest"]);

//ENDPOINTS SERVICES
Route::post("/services/create",[ServicesController::class,"create"])->middleware('auth');
Route::post("/services/update/{id}",[ServicesController::class,"update"])->middleware('auth')->where('id', '[a-z0-9.\-]+');
Route::get("/services/delete/{id}",[ServicesController::class,"delete"])->middleware('auth')->where('id', '[a-z0-9.\-]+');
Route::get("/services/list",[ServicesController::class,"list"])->middleware('auth');

//ENDPOINTS PRODUCTS    
Route::post("/products/create",[ProductsController::class,"create"])->middleware('auth');
Route::post("/products/update/{id}",[ProductsController::class,"update"])->middleware('auth')->where('id', '[a-z0-9.\-]+');
Route::get("/products/delete/{id}",[ProductsController::class,"delete"])->middleware('auth')->where('id', '[a-z0-9.\-]+');
Route::get("/products/list",[ProductsController::class,"list"])->middleware('auth');

//ENDPOINTS CLIENTS    
Route::post("/clients/create",[ClientsController::class,"create"])->middleware('auth');
Route::post("/clients/update/{id}",[ClientsController::class,"update"])->middleware('auth')->where('id', '[a-z0-9.\-]+');
Route::get("/clients/delete/{id}",[ClientsController::class,"delete"])->middleware('auth')->where('id', '[a-z0-9.\-]+');
Route::get("/clients/list",[ClientsController::class,"list"])->middleware('auth');

//ENDPOINTS USERS    
Route::post("/users/create",[UsersController::class,"create"])->middleware('auth');
Route::post("/users/update/{id}",[UsersController::class,"update"])->middleware('auth')->where('id', '[a-z0-9.\-]+');
Route::get("/users/delete/{id}",[UsersController::class,"delete"])->middleware('auth')->where('id', '[a-z0-9.\-]+');
Route::get("/users/list",[UsersController::class,"list"])->middleware('auth');

//ENDPOINTS APPOINTMENTS    
Route::post("/appointments/create",[AppointmentsController::class,"create"])->middleware('auth');
Route::post("/appointments/update/{id}",[AppointmentsController::class,"update"])->middleware('auth')->where('id', '[a-z0-9.\-]+');
Route::get("/appointments/delete/{id}",[AppointmentsController::class,"delete"])->middleware('auth')->where('id', '[a-z0-9.\-]+');
Route::get("/appointments/list",[AppointmentsController::class,"list"])->middleware('auth');

//ENDPOINTS APPOINTMENTS    
Route::post("/sellings/create",[SellingsController::class,"create"])->middleware('auth');
Route::post("/sellings/update/{id}",[SellingsController::class,"update"])->middleware('auth')->where('id', '[a-z0-9.\-]+');
Route::get("/sellings/delete/{id}",[SellingsController::class,"delete"])->middleware('auth')->where('id', '[a-z0-9.\-]+');
Route::get("/sellings/list",[SellingsController::class,"list"])->middleware('auth');