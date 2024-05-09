@extends('layouts.dashboard',[ 'current_route'  => '/dashboard/users'])

@section('title', 'Products - Dashboard') 

@section('content')
    <div class="bg-white relative shadow rounded-lg w-full md:w-5/6  lg:w-4/6 xl:w-3/6 mx-auto mt-20">
        <div class="relative -top-16 -mb-12">    
            <div class="text-center">
                <div class="m-auto text-white flex-shrink-0 object-cover w-32 h-32 p-1 rounded-full text-[80px] bg-gradient-to-tr from-violet-500 to-pink-200">
                    <span>N</span>
                </div>   
            </div>
        </div>
        <div class="">
            <h1 class="font-bold text-center text-3xl text-gray-900 mb-4">Nombre y apellido</h1>
            <p class="text-gray-200 block rounded-lg text-center font-medium leading-6 px-6 py-3 bg-gray-900"><span class="font-bold">Role</span></p> 
            <section class="relative">
                <ul class="flex gap-1 m-2"> 
                </ul>
                <div class="p-10">
                    <hr class="pb-5"/> 
                </div>
            </section>
        </div>
    </div> 
@stop

@section('scripts') 
<script>
    function addTabs(){
        let tabsTitles = '<li class="flex-1">'+
              '<button onClick="" class="w-full text-center p-2 border-[1px] border-gray-200 rounded-md cursor-pointer h-full">'+
                  '{title}'+
              '</button>'+
          '</li>';
    }
    
    function addContentTabs(){
        let tabsContent = '<div key={`tab-${index}`} class={`${current != tab.title ? "invisible opacity-0 z-10 h-0 overflow-hidden": ""}  transition-all duration-[0.2s]`}>'+
            '{tab.content}'+
        '</div>';
    }

    const tabs = [
        {
            title: "Perfil",
            content: (
                <div class="w-full">
                    <h3 class="font-medium text-gray-900 text-left px-6">Perfil</h3>
                    <div class="grid gap-4 grid-cols-1 md:grid-cols-2 m-2 md:m-10 md:mt-2"> 
                        <div class=" mt-[18px]">
                            <div class="relative z-0 group">
                                <input defaultValue="username" readOnly type="text" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " required />
                                <label htmlFor="floating_email" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Nombre de usuario
                                </label>
                            </div>
                        </div>
                        <div class=" mt-[18px]">
                            <div class="relative z-0 group">
                                <input value={email} type="text" name="floating_email" id="floating_email" 
                                       onChange={(e) => {setEmail(e.target.value)}}
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
            )
        },
        {
            title: "Información",
            content: (
                <div class="w-full">
                    <h3 class="font-medium text-gray-900 text-left px-6">Información</h3>
                    <div class="grid gap-4 grid-cols-1 md:grid-cols-2 m-2 md:m-10 md:mt-2"> 
                        <div class=" mt-[18px]">
                            <div class="relative z-0 group">
                                <input defaultValue="Nombre" readOnly type="text" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " required />
                                <label htmlFor="floating_email" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Nombre
                                </label>
                            </div>
                        </div>
                        <div class=" mt-[18px]">
                            <div class="relative z-0 group">
                                <input defaultValue="de usuario" type="text" name="floating_email" id="floating_email"  
                                       class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder="" required />
                                <label htmlFor="floating_email" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Apellido
                                </label>
                            </div>
                        </div>
                        <div class=" mt-[18px]">
                            <div class="relative z-0 group">
                                <input defaultValue="3221233454" type="text" name="floating_email" id="floating_email"  
                                       class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder="" required />
                                <label htmlFor="floating_email" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Telefono
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="my-4 mx-4 md:mx-10">
                        <button class="bg-indigo-600 hover:bg-indigo-800 text-white w-full text-center p-2 border-[1px] border-gray-200 rounded-md cursor-pointer">Guardar</button>
                    </div>
                </div>
            )
        },
        {
            title: "Actividades recientes",
            content: (
                <div class="w-full clear-both">
                    <h3 class="font-medium text-gray-900 text-left px-6">Actividades recientes</h3>
                    <div class="mt-5 w-full flex flex-col items-center overflow-hidden text-sm">
                        <Link href="#" class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                            Crear cita <span class="font-bold">#112392</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">Hace 24 minutos</span>
                        </Link>

                        <Link href="#" class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                            Editar cita <span class="font-bold">#11df92</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">Hace 42 minutos</span>
                        </Link>

                        <Link href="#" class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                            Crear cita <span class="font-bold">#11df92</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">Hace 49 minutos</span>
                        </Link>

                        <Link href="#" class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                            Editar perfil
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">Hace 1 día</span>
                        </Link>

                        <Link href="#" class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150 overflow-hidden">
                            <div class="rounded-full bg-gradient-to-tr from-violet-500 to-pink-200 w-2 h-2 shadow-md inline-block mr-2"></div>
                            Terminar cita  <span class="font-bold">#1e32492</span>
                            <br/><span class="text-[#526270] text-xs ml-2 float-right">Hace 5 días</span>
                        </Link>
                    </div>
                </div>
            )
        }
    ];

</script>
@stop

