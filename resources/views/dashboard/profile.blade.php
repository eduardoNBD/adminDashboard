@extends('layouts.dashboard',[ 'current_route'  => '/dashboard/users'])

@section('title', 'Products - Dashboard') 

@section('content')
    <div class="bg-white relative shadow rounded-lg w-full md:w-5/6  lg:w-4/6 xl:w-3/6 mx-auto mt-20">
        <div class="relative -top-16 -mb-12">    
            <div class="text-center">
                <div class="m-auto text-white flex-shrink-0 object-cover w-32 h-32 p-1 rounded-full text-[80px] bg-gradient-to-tr from-violet-500 to-pink-200">
                    <span>{{strtoupper($user->username[0])}}</span>
                </div>   
            </div>
        </div>
        <div class="">
            <h1 class="font-bold text-center text-3xl text-gray-900 mb-4">{{$user->name}} {{$user->lastname}}</h1>
            <p class="text-gray-200 block rounded-lg text-center font-medium leading-6 px-6 py-3 bg-gray-900"><span class="font-bold">{{$roles[$user->role]}}</span></p> 
            <section class="relative">
                <ul class="flex gap-1 m-2"> 
                    <li class="flex-1">
                        <button onClick="changeTab('#profile')" class="btn-tab bg-indigo-600 text-white w-full text-center p-2 border-[1px] border-gray-200 rounded-md cursor-pointer h-full">
                            Perfil
                        </button>
                    </li>
                    <li class="flex-1">
                        <button onClick="changeTab('#information')" class="btn-tab hover:bg-indigo-600 hover:text-white w-full text-center p-2 border-[1px] border-gray-200 rounded-md cursor-pointer h-full">
                            Información
                        </button>
                    </li>
                    <li class="flex-1">
                        <button onClick="changeTab('#logger')" class="btn-tab hover:bg-indigo-600 hover:text-white w-full text-center p-2 border-[1px] border-gray-200 rounded-md cursor-pointer h-full">
                            Actividades recientes
                        </button>
                    </li>
                </ul>
                <div class="p-10">
                    <hr class="pb-5"/> 
                    <div id="profile" class="tabs-content transition-all duration-[0.2s]">
                        <div class="w-full">
                            <h3 class="font-medium text-gray-900 text-left px-6">Perfil</h3>
                            <div class="grid gap-4 grid-cols-1 md:grid-cols-2 m-2 md:m-10 md:mt-2"> 
                                <div class=" mt-[18px]">
                                    <div class="relative z-0 group">
                                        <input value="{{$user->username}}" readOnly type="text" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " required />
                                        <label htmlFor="floating_email" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Nombre de usuario
                                        </label>
                                    </div>
                                </div>
                                <div class=" mt-[18px]">
                                    <div class="relative z-0 group">
                                        <input value="{{$user->email}}" type="text" name="floating_email" id="floating_email"  
                                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder="" required />
                                        <label htmlFor="floating_email" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Email
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <h3 class="font-medium text-gray-900 text-left mt-4 px-6">Cambiar Contraseña</h3>
                            <div class="px-2 md:px-8"> 
                                <div class=" mt-[18px]">
                                    <div class="relative z-0 group">
                                        <input type="text" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " required />
                                        <label htmlFor="floating_email" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Contraseña
                                        </label>
                                    </div>
                                </div>
                                <div class=" mt-[18px]">
                                    <div class="relative z-0 group">
                                        <input type="text" name="floating_email" id="floating_email"  
                                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder="" required />
                                        <label htmlFor="floating_email" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Nueva Contraseña
                                        </label>
                                    </div>
                                </div>
                                <div class=" mt-[18px]">
                                    <div class="relative z-0 group">
                                        <input type="text" name="floating_email" id="floating_email"  
                                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder="" required />
                                        <label htmlFor="floating_email" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Confirmar Nueva Contraseña
                                        </label>
                                    </div>
                                </div> 
                            </div>
                            <div class="my-4 mx-4 md:mx-10">
                                <button class="bg-indigo-600 hover:bg-indigo-800 text-white w-full text-center p-2 border-[1px] border-gray-200 rounded-md cursor-pointer">Cambiar Contraseña</button>
                            </div>
                        </div>
                    </div>
                    <div id="information" class="invisible opacity-0 z-10 h-0 overflow-hidden tabs-content transition-all duration-[0.2s]">
                        <div class="w-full">
                            <h3 class="font-medium text-gray-900 text-left px-6">Información</h3>
                            <div class="grid gap-4 grid-cols-1 md:grid-cols-2 m-2 md:m-10 md:mt-2"> 
                                <div class=" mt-[18px]">
                                    <div class="relative z-0 group">
                                        <input value="{{$user->name}}" readOnly type="text" name="name" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " required />
                                        <label htmlFor="name" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Nombre
                                        </label>
                                    </div>
                                </div>
                                <div class=" mt-[18px]">
                                    <div class="relative z-0 group">
                                        <input value="{{$user->lastname}}" type="text" name="lastname" id="lastname"  
                                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder="" required />
                                        <label htmlFor="lastname" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Apellido
                                        </label>
                                    </div>
                                </div>
                                <div class=" mt-[18px]">
                                    <div class="relative z-0 group">
                                        <input value="{{$user->phone}}" type="text" name="phone" id="phone"  
                                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder="" required />
                                        <label htmlFor="phone" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Telefono
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="my-4 mx-4 md:mx-10">
                                <button class="bg-indigo-600 hover:bg-indigo-800 text-white w-full text-center p-2 border-[1px] border-gray-200 rounded-md cursor-pointer">Guardar</button>
                            </div>
                        </div>
                    </div>
                    <div id="logger" class="invisible opacity-0 z-10 h-0 overflow-hidden tabs-content transition-all duration-[0.2s]">
                        <div class="w-full clear-both">
                            <h3 class="font-medium text-gray-900 text-left px-6">Actividades recientes</h3>
                            <div class="mt-5 w-full flex flex-col items-center overflow-hidden text-sm">
                                @foreach($logs as $log)
                                    {!! App\Models\Log::getLogText($log) !!}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div> 
    </div> 
@stop

@section('scripts') 
<script>
    function changeTab(content){

        const allTabs = document.querySelectorAll(".btn-tab");
        const allContent = document.querySelectorAll(".tabs-content");
        
        allTabs.forEach(element => {
            element.classList.add("hover:bg-indigo-600","hover:text-white");
            element.classList.remove("bg-indigo-600","text-white");
        });

        allContent.forEach(element => {
            element.classList.add("invisible","opacity-0","z-10","h-0","overflow-hidden"); 
        });

        event.currentTarget.classList.remove("hover:bg-indigo-600","hover:text-white");
        event.currentTarget.classList.add("bg-indigo-600","text-white");
        
        document.querySelector(content).classList.remove("invisible","opacity-0","z-10","h-0","overflow-hidden")
    }

</script>
@stop

