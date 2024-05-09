@extends('layouts.dashboard',[ 'current_route'  => '/dashboard/appointments'])

@section('title', $title.' - Dashboard') 

@section('styles')
    <style> 
        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 999999999999;
            background: #fff;
            top: 100%;
            left: 0;
            right: 0;
            width: 97%;
            margin: auto;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff; 
            border-bottom: 1px solid #d4d4d4; 
            background: #fff;
        }
 
        .autocomplete-items div:hover {
            background-color: #4f46e5; 
            color:white;
        } 

        .autocomplete-active {
            background-color: #4f46e5 !important; 
            color: #ffffff; 
        }
    </style>
@stop

@section('content')
    <section class="bg-white md:px-5 pt-5 pb-5 w-full lg:w-4/6 rounded-lg m-auto mt-5">
        <form onsubmit="submitForm('{{$id ? $menu['baseURL']."/appointments/update/".$id : $menu['baseURL']."/appointments/create" }}','{{$menu['baseURL'].$menu['route']['appointments']['root']}}')" action="#" method="POST">
            @csrf <!-- {{ csrf_field() }} -->
            <h1 class="text-center text-2xl font-bold text-[#526270] pb-4">{{$title}}</h1>
            <hr />
            <div class="grid grid-cols-1 md:grid-cols-2 m-2 md:m-10 md:mt-2"> 
                <div class="px-2 my-2 autocomplete relative mb-5 group"> 
                    <input type="text" name="client" id="clients" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="clients" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Cliente</label>
                </div>
                <div class="px-2 my-2 autocomplete relative mb-5 group"> 
                    <input type="text" name="service" id="services" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="services" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Servicio</label>
                </div>
                <div class="px-2 my-2 relative group">
                    <input type="date" name="date" value="{{$appointment->date}}" id="date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " /> 
                    <label for="date" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Fecha</label>
                </div>
                <div class="px-2 my-2">
                    <div class="flex gap-5"> 
                    <div class="w-3/6 relative group"> 
                            <input type="time" value="{{$appointment->begin}}" id="begin" name="begin" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"/> 
                            <label for="begin" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Hora de inicio</label>
                        </div>
                        <div class="w-3/6 relative group"> 
                            <input type="time" value="{{$appointment->end}}" id="end"  name="end" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"/> 
                            <label for="end" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Hora de fin</label>
                        </div>
                    </div>
                </div>
                <div class="px-2 my-2 autocomplete relative mb-5 group"> 
                    <input type="text" name="user" id="users" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="users" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Atendido por</label>
                </div>
                <div class="px-2 my-2">
                    <div class="relative mb-5 group">
                        <input type="text" name="notes" value="{{$appointment->notes}}" id="notes" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/> 
                        <label for="notes" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Notas de cita</label>
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
<script>
    const clients = JSON.parse('{{json_encode($clients)}}'.replaceAll("&quot;",'"'));
    const services = JSON.parse('{{json_encode($services)}}'.replaceAll("&quot;",'"'));
    const users = JSON.parse('{{json_encode($users)}}'.replaceAll("&quot;",'"'));
    const appointment = JSON.parse('{{json_encode($appointment)}}'.replaceAll("&quot;",'"'));
</script>
<script src="{{ asset('../resources/js/appointment.js') }}"></script> 
@stop
