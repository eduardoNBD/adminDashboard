@extends('layouts.dashboard',[ 'current_route'  => '/dashboard/users'])

@section('title', 'Perfil - Dashboard') 

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
                        <button onClick="changeTab('#profile')" class="btn-tab bg-indigo-600 text-white w-full text-center p-2 border-[1px] border-indigo-600 rounded-md cursor-pointer h-full">
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
                                        <input value="{{$user->username}}" readOnly type="text" name="username" id="username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " required />
                                        <label for="username" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Nombre de usuario
                                        </label>
                                    </div>
                                </div>
                                <div class=" mt-[18px]">
                                    <div class="relative z-0 group">
                                        <input value="{{$user->email}}" readonly type="text" name="email" id="email"  
                                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder="" required />
                                        <label for="email" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Email
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <h3 class="font-medium text-gray-900 text-left mt-4 px-6">Cambiar Contraseña</h3>
                            <form onsubmit="submitForm('{{$menu['baseURL']."/users/updatePassword/"}}')">
                                <div class="px-2 md:px-8"> 
                                    <div class=" mt-[18px]">
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
                                    </div>
                                    <div class=" mt-[18px]">
                                        <div class="col-span-2 md:col-span-1 flex">
                                            <div class="relative z-0 group w-full">
                                                <input type="password" name="new_password" id="new_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " />
                                                <label for="new_password" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nueva contraseña</label>
                                            </div>
                                            <button type="button" onclick="seePasswordInput(document.querySelector('#new_password'))" class="-ml-5 h-full text-sm font-medium focus:outline-none z-20">
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#526270"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                            </button>
                                            <button type="button" onclick="hidePasswordInput(document.querySelector('#new_password'))" class="hidden -ml-5 h-full text-sm font-medium focus:outline-none z-20">
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#526270"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" /><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" /><path d="M3 3l18 18" /></svg>
                                            </button>
                                        </div> 
                                    </div>
                                    <div class=" mt-[18px]">
                                        <div class="col-span-2 md:col-span-1 flex">
                                            <div class="relative z-0 group w-full">
                                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " />
                                                <label for="new_password_confirmation" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirmar nueva contraseña</label>
                                            </div>
                                            <button type="button" onclick="seePasswordInput(document.querySelector('#new_password_confirmation'))" class="-ml-5 h-full text-sm font-medium focus:outline-none z-20">
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#526270"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                            </button>
                                            <button type="button" onclick="hidePasswordInput(document.querySelector('#new_password_confirmation'))" class="hidden -ml-5 h-full text-sm font-medium focus:outline-none z-20">
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#526270"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" /><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" /><path d="M3 3l18 18" /></svg>
                                            </button>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="my-4 mx-4 md:mx-10">  
                                    <p id="messageSuccessPassword" class="text-emerald-500 text-center"></p>
                                    <p id="messageErrorPassword" class="text-red-500 text-center"></p>
                                    <button class="bg-indigo-600 hover:bg-indigo-800 text-white w-full text-center p-2 border-[1px] border-gray-200 rounded-md cursor-pointer">Cambiar Contraseña</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="information" class="invisible opacity-0 z-10 h-0 overflow-hidden tabs-content transition-all duration-[0.2s]">
                        <form onsubmit="saveInformation('{{$menu['baseURL']."/users/updateProfile/"}}')">
                            <div class="w-full">
                                <h3 class="font-medium text-gray-900 text-left px-6">Información</h3>
                                <div class="grid gap-4 grid-cols-1 md:grid-cols-2 m-2 md:m-10 md:mt-2"> 
                                    <div class=" mt-[18px]">
                                        <div class="relative z-0 group">
                                            <input value="{{$user->name}}" type="text" name="name" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" "/>
                                            <label for="name" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                                Nombre
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" mt-[18px]">
                                        <div class="relative z-0 group">
                                            <input value="{{$user->lastname}}" type="text" name="lastname" id="lastname"  
                                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=""/>
                                            <label for="lastname" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                                Apellido
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" mt-[18px]">
                                        <div class="relative z-0 group">
                                            <input value="{{$user->phone}}" type="text" name="phone" id="phone"  
                                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=""/>
                                            <label for="phone" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                                Telefono
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-4 mx-4 md:mx-10"> 
                                    <p id="messageErrorInf" class="text-red-500 text-center"></p>
                                    <p id="messageSuccessInf" class="text-emerald-500 text-center"></p>
                                    <button class="bg-indigo-600 hover:bg-indigo-800 text-white w-full text-center p-2 border-[1px] border-gray-200 rounded-md cursor-pointer">Guardar</button>
                                </div>
                            </div>
                        </form>
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

    function saveInformation(url){
        showLoader();
        event.preventDefault();
        
        const data = new FormData(event.target); 
        
        document.querySelector("#messageSuccessInf").innerHTML = "";
        document.querySelector("#messageErrorInf").innerHTML = "";

        fetch(url, { 
            headers: { 
                "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },  
            method: "post", 
            body: data,
        })
        .then((res) => res.json())
        .then((json) => {
            
            hideLoader();

            if(json.status){
                document.querySelector("#messageSuccessInf").innerHTML = json.message;
                setTimeout(() => {
                    document.querySelector("#messageSuccessInf").innerHTML = "";
                }, "10000");
            }
            else{
                document.querySelector("#messageErrorInf").innerHTML = json.message;
                
                setTimeout(() => {
                    document.querySelector("#messageErrorInf").innerHTML = "";
                }, "10000");
            }
        })
        .catch((err) => console.error("error:", err)); 
    }

    function submitForm(url)
    {
        showLoader();
        event.preventDefault();
        
        const data = new FormData(event.target); 
        
        fetch(url, { 
            headers: { 
                "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json', 
            },  
            method: "post", 
            body: data,
        })
        .then((res) => { 
            if (!res.ok) { 
                setTimeout(() => {
                    document.querySelector("#errorMessagePassword").innerHTML = ""; 
                    location.href = baseURLDashboard;
                }, "5000");
            }

            return res.json();
        })
        .then((json) => {
            
            hideLoader();

            if(json.status){
                document.querySelector("#messageSuccessPassword").innerHTML = json.message;
                setTimeout(() => {
                    document.querySelector("#messageSuccessPassword").innerHTML = "";
                }, "10000");
            }
            else{
                document.querySelector("#messageErrorPassword").innerHTML = json.message;
                
                setTimeout(() => {
                    document.querySelector("#messageErrorPassword").innerHTML = "";
                }, "10000");
            }
        })
        .catch((err) => console.error("error:", err)); 

    }
</script>
@stop

