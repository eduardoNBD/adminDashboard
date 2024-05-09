@extends('layouts.dashboard',[ 'current_route'  => '/dashboard/clients'])

@section('title', 'Clients - Dashboard') 

@section('content') 
<section class="bg-white md:px-5 pt-5 pb-5 w-full lg:w-4/6 rounded-lg m-auto mt-5"> 
    <form onsubmit="submitForm('{{$id ? $menu['baseURL']."/clients/update/".$id : $menu['baseURL']."/clients/create" }}','{{$menu['baseURL'].$menu['route']['clients']['root']}}')" action="#" method="POST">
        @csrf <!-- {{ csrf_field() }} -->
        <h1 class="text-center text-2xl font-bold text-[#526270] pb-4">{{$title}}</h1>
        <hr />
        <div class="grid grid-cols-1 md:grid-cols-2 m-2 md:m-10 md:mt-2"> 
            <div class="px-2 my-2 mt-[18px]">
                <div class="relative z-0 mb-5 group">
                    <input type="text" name="name" value="{{$client->name}}" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " />
                    <label for="name" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
                </div>
            </div>
            <div class="px-2 my-2 mt-[18px]">
                <div class="relative z-0 mb-5 group">
                    <input type="text" name="lastname" value="{{$client->lastname}}" id="lastname" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " />
                    <label for="lastname" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Apellido</label>
                </div>
            </div>
            <div class="px-2 my-2 mt-[18px]">
                <div class="relative z-0 mb-5 group">
                    <input type="email" name="email" value="{{$client->email}}" id="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " />
                    <label for="email" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                </div>
            </div>
            <div class="px-2 my-2 mt-[18px]">
                <div class="relative z-0 mb-5 group">
                    <input type="text" name="phone" value="{{$client->phone}}" id="phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " />
                    <label for="phone" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Teléfono</label>
                </div>
            </div>
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
<script src="{{ asset('../resources/js/client.js') }}"></script> 
@stop
