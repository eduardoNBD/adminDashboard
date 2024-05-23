<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\LogsController;
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

//ENDPOINTS AUTH
Route::post("/auth/login",[LoginController::class,"LoginRequest"]);

/*--------------------------------ROUTES CLIENTS----------------------------------*/

//VIEWS CLIENTS
Route::get("/dashboard/clients",[DashboardController::class,"clients"])->middleware('auth');
Route::get("/dashboard/clients/{page}",[DashboardController::class,"clients"])->middleware('auth')->where('page', '[0-9]+');
Route::get("/dashboard/clients/client",[DashboardController::class,"client"])->middleware('auth');
Route::get("/dashboard/clients/client/{id}",[DashboardController::class,"client"])->middleware('auth')->where('id', '[a-z0-9.\-]+');

//ENDPOINTS CLIENTS    
Route::post("/clients/create",[ClientsController::class,"create"])->middleware('auth');
Route::post("/clients/update/{id}",[ClientsController::class,"update"])->middleware('auth')->where('id', '[a-z0-9.\-]+');
Route::get("/clients/delete/{id}",[ClientsController::class,"delete"])->middleware('auth')->where('id', '[a-z0-9.\-]+');
Route::get("/clients/recover/{id}",[ClientsController::class,"recover"])->middleware(['auth', 'roles:1'])->where('id', '[a-z0-9.\-]+');
Route::get("/clients/list",[ClientsController::class,"list"])->middleware('auth');

/*------------------------------------------------------------------------------*/

/*--------------------------------ROUTES APPOINTMENTS----------------------------------*/

//VIEWS APPOINTMENTS
Route::get("/dashboard/appointments",[DashboardController::class,"appointments"])->middleware('auth');
Route::get("/dashboard/appointments/{page}",[DashboardController::class,"appointments"])->middleware('auth')->where('page', '[0-9]+');
Route::get("/dashboard/appointments/appointment/",[DashboardController::class,"appointment"])->middleware('auth');
Route::get("/dashboard/appointments/appointment/{id}",[DashboardController::class,"appointment"])->middleware('auth')->where('id', '[a-z0-9.\-]+');

//ENDPOINTS APPOINTMENTS    
Route::post("/appointments/create",[AppointmentsController::class,"create"])->middleware('auth');
Route::post("/appointments/update/{id}",[AppointmentsController::class,"update"])->middleware('auth')->where('id', '[a-z0-9.\-]+');
Route::get("/appointments/delete/{id}",[AppointmentsController::class,"delete"])->middleware('auth')->where('id', '[a-z0-9.\-]+');
Route::get("/appointments/list",[AppointmentsController::class,"list"])->middleware('auth');
Route::get("/appointments/user/{id}",[AppointmentsController::class,"getAppointmentsByUser"])->middleware(['auth', 'roles:1'])->where('id', '[a-z0-9.\-]+');
/*------------------------------------------------------------------------------*/

/*--------------------------------ROUTES PRODUCTS----------------------------------*/

//VIEWS PRODUCTS
Route::get("/dashboard/products",[DashboardController::class,"products"])->middleware('auth');
Route::get("/dashboard/products/{page}",[DashboardController::class,"products"])->middleware('auth')->where('page', '[0-9]+');
Route::get("/dashboard/products/product",[DashboardController::class,"product"])->middleware('auth');
Route::get("/dashboard/products/product/{id}",[DashboardController::class,"product"])->middleware('auth')->where('id', '[a-z0-9.\-]+');

//ENDPOINTS PRODUCTS    
Route::post("/products/create",[ProductsController::class,"create"])->middleware(['auth', 'roles:1']);
Route::post("/products/update/{id}",[ProductsController::class,"update"])->middleware(['auth', 'roles:1'])->where('id', '[a-z0-9.\-]+');
Route::get("/products/delete/{id}",[ProductsController::class,"delete"])->middleware(['auth', 'roles:1'])->where('id', '[a-z0-9.\-]+');
Route::get("/products/recover/{id}",[ProductsController::class,"recover"])->middleware(['auth', 'roles:1'])->where('id', '[a-z0-9.\-]+');
Route::get("/products/list",[ProductsController::class,"list"])->middleware(['auth', 'roles:1']);

/*------------------------------------------------------------------------------*/

/*--------------------------------ROUTES SERVICES----------------------------------*/

//VIEWS SERVICES
Route::get("/dashboard/services",[DashboardController::class,"services"])->middleware(['auth', 'roles:1']);
Route::get("/dashboard/services/{page}",[DashboardController::class,"services"])->middleware(['auth', 'roles:1'])->where('page', '[0-9]+');
Route::get("/dashboard/services/service",[DashboardController::class,"service"])->middleware(['auth', 'roles:1']);
Route::get("/dashboard/services/service/{id}",[DashboardController::class,"service"])->middleware(['auth', 'roles:1'])->where('id', '[a-z0-9.\-]+');

//ENDPOINTS SERVICES
Route::post("/services/create",[ServicesController::class,"create"])->middleware(['auth', 'roles:1']);
Route::post("/services/update/{id}",[ServicesController::class,"update"])->middleware(['auth', 'roles:1'])->where('id', '[a-z0-9.\-]+');
Route::get("/services/delete/{id}",[ServicesController::class,"delete"])->middleware(['auth', 'roles:1'])->where('id', '[a-z0-9.\-]+');
Route::get("/services/recover/{id}",[ServicesController::class,"recover"])->middleware(['auth', 'roles:1'])->where('id', '[a-z0-9.\-]+');
Route::get("/services/list",[ServicesController::class,"list"])->middleware(['auth', 'roles:1']);

/*------------------------------------------------------------------------------*/

/*--------------------------------ROUTES SELLINGS-------------------------------*/

//VIEWS SELLINGS
Route::get("/dashboard/sellings",[DashboardController::class,"sellings"])->middleware(['auth', 'roles:1']);
Route::get("/dashboard/sellings/{page}",[DashboardController::class,"sellings"])->middleware(['auth', 'roles:1'])->where('page', '[0-9]+');
Route::get("/dashboard/sellings/selling",[DashboardController::class,"selling"])->middleware(['auth', 'roles:1']);
Route::get("/dashboard/sellings/selling/{id}",[DashboardController::class,"selling"])->middleware(['auth', 'roles:1'])->where('id', '[a-z0-9.\-]+');

//ENDPOINTS SELLINGS    
Route::post("/sellings/create",[SellingsController::class,"create"])->middleware(['auth', 'roles:1']);
Route::post("/sellings/update/{id}",[SellingsController::class,"update"])->middleware(['auth', 'roles:1'])->where('id', '[a-z0-9.\-]+');
Route::get("/sellings/delete/{id}",[SellingsController::class,"delete"])->middleware(['auth', 'roles:1'])->where('id', '[a-z0-9.\-]+');
Route::get("/sellings/list",[SellingsController::class,"list"])->middleware(['auth', 'roles:1']);

/*------------------------------------------------------------------------------*/


/*--------------------------------ROUTES USERS----------------------------------*/

//VIEWS USERS
Route::get("/dashboard/users",[DashboardController::class,"users"])->middleware(['auth', 'roles:1']);
Route::get("/dashboard/users/{page}",[DashboardController::class,"users"])->middleware(['auth', 'roles:1'])->where('page', '[0-9]+');
Route::get("/dashboard/users/user",[DashboardController::class,"user"])->middleware(['auth', 'roles:1']);
Route::get("/dashboard/users/user/{id}",[DashboardController::class,"user"])->middleware(['auth', 'roles:1'])->where('id', '[a-z0-9.\-]+');
Route::get("/dashboard/users/detail/{id}",[DashboardController::class,"userDetail"])->middleware(['auth', 'roles:1'])->where('id', '[a-z0-9.\-]+');
Route::get("/dashboard/profile",[DashboardController::class,"profile"])->middleware('auth');

//ENDPOINTS USERS    
Route::post("/users/create",[UsersController::class,"create"])->middleware(['auth', 'roles:1']);
Route::post("/users/update/{id}",[UsersController::class,"update"])->middleware(['auth', 'roles:1'])->where('id', '[a-z0-9.\-]+');
Route::post("/users/updateProfile/",[UsersController::class,"updateProfile"])->middleware('auth');
Route::post("/users/updatePassword/",[UsersController::class,"updatePassword"])->middleware('auth');
Route::post("/users/updatePasswordForUser/{id}",[UsersController::class,"updatePasswordForUser"])->middleware(['auth', 'roles:1'])->where('id', '[a-z0-9.\-]+');
Route::get("/users/recover/{id}",[UsersController::class,"recover"])->middleware(['auth', 'roles:1'])->where('id', '[a-z0-9.\-]+');
Route::get("/users/delete/{id}",[UsersController::class,"delete"])->middleware(['auth', 'roles:1'])->where('id', '[a-z0-9.\-]+');
Route::get("/users/list",[UsersController::class,"list"])->middleware(['auth', 'roles:1']);

/*------------------------------------------------------------------------------*/


/*--------------------------------ROUTES LOGS----------------------------------*/

//ENDPOINTS LOGS
Route::get("/logs/user/{id}",[LogsController::class,"getLogsByUser"])->middleware('auth')->where('id', '[a-z0-9.\-]+');

/*------------------------------------------------------------------------------*/


