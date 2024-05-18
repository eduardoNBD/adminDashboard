<section class="bg-violet-500 relative shadow-md rounded-lg p-8 h-full"> 
    <div class="grid grid-cols-4">
        <main class="col-span-4 md:col-span-2">
            <article class="p-10 text-white">
                <h1 class="text-5xl font-bold mb-2">Bienvenido</h1>
                <h2 class="text-3xl font-semibold">@auth {{Auth::user()->name." ".Auth::user()->lastname}} @endauth</h2>
                <p class="text-xl mt-4">¿Que deseas hacer?</p>
                <div class="grid grid-cols-2 mt-10 gap-3">
                    <a href="{{$menu['baseURL'].$menu['route']['appointments']['new']}}" class="col-span-2 sm:col-span-1 w-full text-center m-auto bg-indigo-600 text-white group px-4 py-2.5 text-sm font-medium transition-all duration-200 rounded-lg flex justify-center items-center">
                        <p class="flex items-center"><svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0 mr-2 w-6 h-6"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10.5 21h-4.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v3"></path><path d="M16 3v4"></path><path d="M8 3v4"></path><path d="M4 11h10"></path><path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path><path d="M18 16.5v1.5l.5 .5"></path></svg>
                        Crear Cita</p>
                    </a>
                    <a href="{{$menu['baseURL'].$menu['route']['sellings']['new']}}" class="col-span-2 sm:col-span-1 w-full text-center m-auto bg-indigo-600 text-white group px-4 py-2.5 text-sm font-medium transition-all duration-200 rounded-lg flex justify-center items-center">
                        <p class="flex items-center"><svg class="flex-shrink-0 mr-2 w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 9m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z"></path><path d="M14 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path><path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2"></path></svg>
                        Crear venta</p>
                    </a>
                </div>
            </article>
        </main>
        <aside class="hidden md:block col-span-4 md:col-span-2">
            <img class="w-8/12 ml-auto" src="{{asset('../resources/img/welcome.png') }}" alt="">
        </aside>
    </div>
</section>