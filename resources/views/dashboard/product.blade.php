@extends('layouts.dashboard',[ 'current_route'  => '/dashboard/products'])

@section('title', $title.' - Dashboard') 

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <section class="bg-white md:px-5 pt-5 pb-5 w-full rounded-lg mt-2">
        <img id="img-product" width="180" height="180" alt="service picture" class="border-2 b-[#444444] m-auto h-[180px] w-[180px] mb-10 bg-purple-500 rounded-full" src="{{ $product->image ? asset("../storage/app/").'/'.$product->image : asset('../resources/img/noimg.jpg') }}" /> 
        <div class="relative w-4/6 m-auto">
            <label title="Click to upload" for="imgProduct" class="text-center cursor-pointer flex items-center gap-4 px-6 py-4 before:border-gray-400/60 hover:before:border-gray-300 group before:bg-gray-100 before:absolute before:inset-0 before:rounded-3xl before:border before:border-dashed before:transition-transform before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">
                <div class="w-max relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 64 64" fill="none">
                        <path d="M32.381 18.167V45.166" stroke="#4f46e5" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M41.381 24.167L32.381 18.167L23.382 24.167" stroke="#4f46e5" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M32.382 58.334C47.1098 58.334 59.049 46.3948 59.049 31.667C59.049 16.9392 47.1098 5 32.382 5C17.6542 5 5.715 16.9392 5.715 31.667C5.715 46.3948 17.6542 58.334 32.382 58.334Z" stroke="#4f46e5" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="relative">
                    <span class="block text-base font-semibold relative text-blue-900 group-hover:text-blue-500">
                        Subir foto de Servicio
                    </span> 
                </div>
            </label>
            <input class="opacity-0 absolute top-0 w-full h-full cursor-pointer" onChange="handleChange()" type="file" name="imgProduct" id="imgProduct" 
            />
        </div>
    </section>
    <section class="bg-white md:px-5 pt-5 pb-5 w-full rounded-lg mt-2 col-span-2">
        <form onsubmit="submitForm('{{$id ? $menu['baseURL']."/products/update/".$id : $menu['baseURL']."/products/create" }}','{{$menu['baseURL'].$menu['route']['products']['root']}}')" action="#" method="POST">
            @csrf <!-- {{ csrf_field() }} -->
            <h1 class="text-center text-2xl font-bold text-[#526270] pb-4">{{$title}}</h1>
            <hr />
            <div class="grid grid-cols-1 md:grid-cols-2 m-2 md:m-10 md:mt-2"> 
                <div class="px-2 my-2 mt-[18px]">
                    <div class="relative z-0 mb-5 group">
                        <input type="text" value="{{$product->name}}" name="name" id="name_service" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder="" />
                        <label htmlFor="name_service" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre de Servicio</label>
                    </div>
                </div>
                <div class="px-2 my-2 mt-[18px]">
                    <div class="relative z-0 mb-5 group">
                        <input type="text" value="{{$product->key}}" name="key" id="key_service" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder="" />
                        <label htmlFor="key_service" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Clave</label>
                    </div>
                </div>
                <div class="px-2 my-2 mt-[18px]">
                    <div class="relative z-0 mb-5 group">
                        <input type="text" value="{{$product->price}}" name="price" id="price_service" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder="" />
                        <label htmlFor="price_service" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Precio</label>
                    </div>
                </div>  
                <div class="col-span-2 text-right"> 
                    <label id="errorMessage" class="text-red-600 text-left block"></label>
                    <button class="bg-violet-600 text-white border-violet-600 border-2 rounded-md px-10 py-1">Enviar</button>
                </div>
            </div>
        </form>
    </section>
</div>
@stop

@section('scripts')
<script src="{{ asset('../resources/js/product.js') }}"></script> 
@stop
