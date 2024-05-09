@extends('layouts.dashboard',[ 'current_route'  => '/dashboard/users'])

@section('title', 'Appointments - Dashboard') 

@section('content') 
 
<section class="bg-white px-5 pt-5 pb-5 w-full lg:w-4/6 rounded-lg m-auto mt-5">
    <form onsubmit="submitForm('{{$id ? $menu['baseURL']."/users/update/".$id : $menu['baseURL']."/users/create" }}','{{$menu['baseURL'].$menu['route']['users']['root']}}')" action="#" method="POST">
        @csrf <!-- {{ csrf_field() }} -->
        <h1 class="text-center text-2xl font-bold text-[#526270] pb-4">{{$title}}</h1>
        <hr />
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5"> 
            <div class="col-span-2 md:col-span-1">
                <div class="relative z-0 group">
                    <input type="text" name="username" value="{{$user->username}}" id="username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " />
                    <label for="username" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre usuario</label>
                </div>
            </div>
            <div class="col-span-2 md:col-span-1"> 
                <div class="relative z-0 group"> 
                    <select id="roles" name="role" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer">
                        @foreach ($roles as $key => $role)
                            <option value="{{$key}}" {{$user->role == $key ? "selected" : ""}}>{{ $role }}</option>
                        @endforeach
                    </select>  
                    <label for="roles" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Rol de usuario</label>
                </div>
            </div>
            <div class="col-span-2 md:col-span-1">
                <div class="relative z-0 group">
                    <input type="text" name="name" value="{{$user->name}}" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " />
                    <label for="name" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
                </div>
            </div>
            <div class="col-span-2 md:col-span-1">
                <div class="relative z-0 group">
                    <input type="text" name="lastname" value="{{$user->lastname}}" id="lastname" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " />
                    <label for="lastname" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Apellido</label>
                </div>
            </div>
            <div class="col-span-2 md:col-span-1">
                <div class="relative z-0 group">
                    <input type="email" name="email" value="{{$user->email}}" id="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " />
                    <label for="email" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                </div>
            </div>
            <div class="col-span-2 md:col-span-1">
                <div class="relative z-0 group">
                    <input type="text" name="phone" value="{{$user->phone}}" id="phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " />
                    <label for="phone" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Teléfono</label>
                </div>
            </div>
            @if (!$user->id)
                <div class="col-span-2 md:col-span-1 flex">
                    <div class="relative z-0 group w-full">
                        <input type="password" name="password" id="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " />
                        <label for="password" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Contraseña</label>
                    </div>
                    <button type="button" onclick="seePasswordInput(document.querySelector('#password'))" class="-ml-5 h-full text-sm font-medium focus:outline-none z-20">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#526270"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                    </button>
                    <button type="button" onclick="hidePasswordInput(document.querySelector('#password'))" class="hidden -ml-5 h-full text-sm font-medium focus:outline-none z-20">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#526270"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" /><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" /><path d="M3 3l18 18" /></svg>
                    </button>
                </div>
                <div class="col-span-2 md:col-span-1 flex">
                    <div class="relative z-0 group w-full">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " />
                        <label for="password_confirmation" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirmar contraseña</label>
                    </div>
                    <button type="button" onclick="seePasswordInput(document.querySelector('#password_confirmation'))" class="-ml-5 h-full text-sm font-medium focus:outline-none z-20">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#526270"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                    </button>
                    <button type="button" onclick="hidePasswordInput(document.querySelector('#password_confirmation'))" class="hidden -ml-5 h-full text-sm font-medium focus:outline-none z-20">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#526270"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" /><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" /><path d="M3 3l18 18" /></svg>
                    </button>
                </div> 
            @endif
            <div class="col-span-2 text-right">
                <label id="errorMessage" class="text-red-600 text-left block"></label>
                <button class="bg-violet-600 text-white border-violet-600 border-2 rounded-md px-10 py-1">
                    Enviar
                </button>
            </div>
        </div>
    </form>
</section>
@stop

@section('scripts')
<script src="{{ asset('../resources/js/user.js') }}"></script> 
@stop
