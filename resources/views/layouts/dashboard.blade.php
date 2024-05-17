<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width,initial-scale=1.0"> 
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
        <link href="{{ asset('../resources/css/build.css') }}" rel="stylesheet"> 
        @yield('styles') 
    </head>
    <body> 
        <div class="h-screen">
            <div class="flex p-2 w-full bg-white">
                <div class="flex gap-2 w-6/12 md:w-64">
                    <button class="px-2 border-1 md:hidden sm:block" id="buttonNav" onclick="openNavbar()"> 
                        <img class="w-5 h-5 ml-auto" src="{{ asset('../resources/img/menuIconOpen.svg') }}" alt="buttonMenu" id="buttonMEnu">
                    </button>
                    <div class="mt-2 rounded-full bg-gradient-to-tr from-violet-500 to-pink-400 w-[50px] h-[50px]" ></div>
                    <p class="content-center">LOGO</p>
                </div>
                <div class="w-6/12 md:w-full">
                    <button type="button" class="group relative flex items-center float-end justify-center  px-4 py-3 text-sm font-medium text-gray-900 transition-all duration-200 rounded-lg hover:bg-gray-100">
                        <div class="align-middle text-white flex-shrink-0 object-cover w-[40px] h-[40px] p-1 mr-3 rounded-full text-lg bg-gradient-to-tr from-violet-500 to-pink-200">
                            <span>@auth {{strtoupper(Auth::user()->username[0])}} @endauth</span>
                        </div>
                        @auth{{Auth::user()->username}}   @endauth
                        <svg class="w-5 h-5 ml-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                        </svg>
                        <div class="z-10 hidden group-hover:block text-left w-full border-[1px] absolute left-0 top-16 bg-white rounded-md p-2 ]">
                            <a href="{{$menu['baseURL']."/dashboard/profile"}}" class="p-2 block">Perfil</a>
                            <hr />
                            <a  href="{{$menu['baseURL']}}/logout" class="p-2 block">Cerrar sesion</a>
                            <hr />
                        </div>
                    </button> 
                </div>
            </div> 
            <div class="flex bg-[#ededed] border-t-[1px] border-gray-200 ">
                <div class="md:flex md:w-64 md:flex-col z-10" id="NavBarContent">
                    <div class="h-screen flex flex-col flex-grow pt-5 overflow-y-auto bg-white">
                        <div class="flex flex-col flex-1 px-1">
                            <div class="space-y-4"> 
                                @foreach ($menu['menu'] as $key => $group)
                                    <nav class="flex-1 space-y-2">
                                        @foreach ($group as $keyR => $route)
                                            <a href="{{$menu['baseURL'].$route['route']}}" class="{{$route['route'] == $current_route ? "bg-indigo-600 text-white" : "text-[#526270] hover:text-white hover:bg-indigo-600"}} group flex items-center px-4 py-2.5 text-sm font-medium transition-all duration-200 rounded-lg">
                                                {!! $route['icon'] !!}
                                                <span>{{$route['title']}}</span>
                                                {!!
                                                    $route['button'] != null ?
                                                        '<button onClick="goToURL('.(!empty($route['button']) ? "'".$menu['baseURL'].$route['button']['url']."/'" : '#').', event)" 
                                                                class="group-hover:opacity-100 ml-auto bg-violet-500 text-white rounded-lg opacity-0 p-2">
                                                        '.$route['button']['icon'].'
                                                        </button>' : 
                                                        "" 
                                                !!}
                                            </a>  
                                        @endforeach  
                                    <hr class="border-gray-200" />
                                    </nav> 
                                @endforeach  
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="flex flex-col flex-1"> 
                    <main class="p-2">  
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
        <div id="loader" class="flex justify-center items-center h-screen w-screen top-0 absolute bg-[#ffffffaa] left-0 z-10">
            <div class="rounded-full h-20 w-20 bg-violet-800 animate-ping"></div>
        </div>
        <script src="{{ asset('../resources/js/app.js') }}"></script> 
        @yield('scripts') 
    </body>
</html>
 