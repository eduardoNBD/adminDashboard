@extends('layouts.dashboard',[ 'current_route'  => '/dashboard/users'])

@section('title', 'Detalle de usuario - Dashboard') 

@section('content') 
<div class="grid grid-cols-1 md:grid-cols-12 gap-2">
    <div class="col-span-12 md:col-span-3">
        <section class="bg-white rounded-md p-4 border-2 border-t-4 border-white border-t-violet-600 overflow-hidden">
            <header class="text-center mb-2"> 
                <div class="text-right">
                    <a href="{{$menu['baseURL'].$menu['route']['users']['edit']($user->id)}}"  class="float-right inline-block text-emerald-800" title="Editar">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  float-right icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                    </a>
                </div>
                <div class="m-auto text-white flex-shrink-0 object-cover w-32 h-32 p-1 rounded-full text-[80px] bg-gradient-to-tr from-violet-500 to-pink-200">
                    <span>{{strtoupper($user->username[0])}}</span>
                </div> 
                <h1 class="text-2xl font-bold text-gray-700 mt-2">{{$user->username}}</h1>
                <span class="text-gray-400">{{$user->role}}</span>
            </header>
            <main>
                <hr>
                <p class="p-2"><span class="font-bold">Nombre: </span><span class="float-right">{{$user->name}} {{$user->lastname}}</span></p> 
                <hr>
                <p class="p-2"><span class="font-bold">E-mail: </span><span class="float-right">{{$user->email}}</span></p> 
                <hr>
                <p class="p-2"><span class="font-bold">Teléfono: </span><span class="float-right">{{$user->phone}}</span></p> 
                <hr>
            </main>
        </section>
    </div>
    <div class="col-span-12 md:col-span-9">
        <section class="bg-white rounded-md">
            <ul class="flex bg-[#ededed]"> 
                <li class="flex-1">
                    <button onClick="getAppointments();changeTab('#latestAppointments')" class="btn-tab bg-indigo-600 text-white w-full text-center p-2 border-[1px] border-indigo-600 cursor-pointer h-full rounded-tl-lg rounded-tr-lg">
                        Proximas citas
                    </button>
                </li> 
                <li class="flex-1">
                    <button onClick="getLogs();changeTab('#logger')" class="btn-tab bg-white hover:bg-indigo-600 hover:text-white w-full text-center p-2 border-[1px] border-gray-200 cursor-pointer h-full rounded-tl-lg rounded-tr-lg">
                        Actividades 
                    </button>
                </li>
                <li class="flex-1">
                    <button onClick="changeTab('#sellings')" class="btn-tab bg-white hover:bg-indigo-600 hover:text-white w-full text-center p-2 border-[1px] border-gray-200 cursor-pointer h-full rounded-tl-lg rounded-tr-lg">
                        Ventas recientes 
                    </button>
                </li>
            </ul>
            <hr>
            <div class="p-10">
                <hr class="pb-5"/> 
                <div id="latestAppointments" class="tabs-content transition-all duration-[0.2s]">
                    <div class="w-full"> 
                        <div id="appointmentsContent">
                            
                        </div>
                        <nav id="paginationAppo" class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                         
                        </nav>
                    </div>
                </div> 
                <div id="logger" class="invisible opacity-0 z-10 h-0 overflow-hidden tabs-content transition-all duration-[0.2s]">
                    <div class="w-full">
                        <div id="logsContent">
                            
                        </div>
                        <nav id="paginationLogs" class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                         
                        </nav>
                    </div>
                </div>
                <div id="sellings" class="invisible opacity-0 z-10 h-0 overflow-hidden tabs-content transition-all duration-[0.2s]">
                    <h2 class="px-4 p-2 text-lg">Ventas de los ultimos meses</h2>
                    <hr>
                    <ul class="">
                        @foreach ($sellings as $key => $sell)
                            <li class="pb-2 px-2 py-2 border-b border-b-gray-300"><span class="font-bold">{{$sell->month}}</span> <span class="float-right rounded-lg text-[10px] text-white bg-emerald-600 py-1 px-2 font-bold">$ {{number_format($sell->total,2,".",",")}}</span></li>
                        @endforeach
                    </ul>
                </div>
        </section>
    </div>
</div>
@stop

@section('scripts')
<script> 
    let currentPageApp = {{isset($_GET['currentPageApp']) ? $_GET['currentPageApp'] : 1}};
    let currentPageLog = {{isset($_GET['currentPageLog']) ? $_GET['currentPageLog'] : 1}};

    function getAppointments(){
         
        fetch('{{$menu['baseURL']."/appointments/user/".$user->id."?page="}}'+currentPageApp, { 
            headers: { 
                "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },   
        })
        .then((res) => res.json())
        .then((json) => { 
            if(json.status)
            { 
                totalPages = Math.ceil(json.appointments.total/json.appointments.per_page);
                currentPage = json.appointments.current_page;
                 
                document.querySelector("#paginationAppo").innerHTML = "";

                if(totalPages > 1){
                    setPagesAppointments(currentPage, totalPages);
                }

                setRowsAppointments(json.appointments.data);
            } 
        })
        .catch((err) => console.error("error:", err)); 
        
    }

    function setRowsAppointments(data){ 
        document.querySelector("#appointmentsContent").innerHTML = "";

        if(data.length){ 
            data.forEach(appointment => { 
                let rowHTML =   '<div>'+
                                    '<div>'+
                                        '<a href="{{$menu['baseURL'].$menu['route']['appointments']['edit']('')}}'+appointment.id+'" class="font-medium font-bold text-[#526270] mr-2">Cita #'+appointment.no+'</a>'+
                                        (appointment.client_id != null ? appointment.client_id : "Sin cliente Definido")+
                                        '<span class="block text-center md:inline-block rounded-lg text-[10px] text-white bg-indigo-600 py-1 px-2 font-bold float-right">'+reformatDate(appointment.date+' '+appointment.begin)+'</span>'+
                                    '</div>'+
                                    '<div class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell">'+(appointment.service_id != null ? appointment.service_id : "Sin servicio Definido")+'</div>'+
                                    '<hr class="mb-2">'+
                                '</div>'; 
                var temp       = document.createElement('div');
                temp.innerHTML = rowHTML;
            
                document.querySelector("#appointmentsContent").appendChild(temp.childNodes[0]); 
            });      
        }else{
            let rowHTML = '<h1 class="text-center text-3xl m-10">Sin Citas</h1>';
            var temp       = document.createElement('tbody');
            temp.innerHTML = rowHTML;
        
            document.querySelector("#appointmentsContent").appendChild(temp.childNodes[0]); 
        }       
    }

    function setPagesAppointments(currentPage, totalPages) { 
        const pagesToShow = 2;  
        const maxPagesToShow = pagesToShow * 2 + 1; 

        let startPage = Math.max(1, currentPage - pagesToShow);
        let endPage = Math.min(totalPages, currentPage + pagesToShow);

        if (currentPage - pagesToShow <= 1) {
            endPage = Math.min(startPage + maxPagesToShow - 1, totalPages);
        }

        if (currentPage + pagesToShow >= totalPages) {
            startPage = Math.max(endPage - maxPagesToShow + 1, 1);
        }

        startPage = Math.max(1, startPage);
        endPage = Math.min(totalPages, endPage);

        let paginationHTML = '<ul class="inline-flex ml-auto items-stretch -space-x-px">';
        
        paginationHTML += '<li class="page-item">';
        paginationHTML += '<button ' + (currentPage === 1 ? ' disabled' : '') + ' class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-[#526270] bg-white border border-gray-300 hover:bg-violet-500 hover:border-y-violet-500 hover:text-white hover:text-gray-700" onclick="changePageAppo(' + (currentPage - 1) + ')">Anterior</button>';
        paginationHTML += '</li>';

        for (let page = startPage; page <= endPage; page++) {
            paginationHTML += '<li class="page-item' + (currentPage === page ? ' active' : '') + '">';
            paginationHTML += '<button class="flex items-center justify-center text-sm py-2 px-3 leading-tight ' + (currentPage === page ? 'border border-violet-500 bg-violet-500 text-white' : 'text-[#526270] bg-white border hover:bg-violet-500 hover:border-y-violet-500 hover:text-white hover:text-gray-700 border-gray-300 ') + '" onclick="changePageAppo(' + page + ')">' + page + '</button>';
            paginationHTML += '</li>';
        }

        paginationHTML += '<li class="page-item">';
        paginationHTML += '<button ' + (currentPage === totalPages ? ' disabled' : '') + ' class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-[#526270] bg-white border border-gray-300 hover:bg-violet-500 hover:border-y-violet-500 hover:text-white hover:text-gray-700" onclick="changePageAppo(' + (currentPage + 1) + ')">Siguiente</button>';
        paginationHTML += '</li>';

        paginationHTML += '</ul>';

        var temp       = document.createElement('div');
        temp.innerHTML = (paginationHTML);

        document.querySelector("#paginationAppo").appendChild(temp.childNodes[0]); 
    }

    function changePageAppo(page)
    {
        currentPageApp = page;
        getAppointments(); 
        window.history.pushState({}, 'Citas - Dashboard', "{{$menu['baseURL'].$menu['route']['users']['detail']($user->id)}}/?currentPageApp="+currentPageApp+"&currentPageLog="+currentPageLog);
    }
    
    function getLogs(){
         
         fetch('{{$menu['baseURL']."/logs/user/".$user->id."?page="}}'+currentPageLog, { 
             headers: { 
                 "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
             },   
         })
         .then((res) => res.json())
         .then((json) => { 
             if(json.status)
             { 
                 totalPages = Math.ceil(json.logs.total/json.logs.per_page);
                 currentPage = json.logs.current_page;
                  
                 document.querySelector("#paginationLogs").innerHTML = "";
 
                 if(totalPages > 1){
                     setPagesLogs(currentPage, totalPages);
                 }
 
                 setRowsLogs(json.logs.data);
             } 
         })
         .catch((err) => console.error("error:", err)); 
         
     }
 
     function setRowsLogs(data){ 
         document.querySelector("#logsContent").innerHTML = "";
 
         if(data.length){ 
             data.forEach(log => { 
                 
                 var temp       = document.createElement('div');
                 temp.innerHTML = "<div>"+log.htmlAction+"<hr></div>";
             
                 document.querySelector("#logsContent").appendChild(temp.childNodes[0]); 
             });      
         }else{
             let rowHTML = '<h1 class="text-center text-3xl m-10">Sin actividades</h1>';
             var temp       = document.createElement('div');
             temp.innerHTML = rowHTML;
         
             document.querySelector("#logsContent").appendChild(temp.childNodes[0]); 
         }       
     }
 
     function setPagesLogs(currentPage, totalPages) { 
         const pagesToShow = 2;  
         const maxPagesToShow = pagesToShow * 2 + 1; 
 
         let startPage = Math.max(1, currentPage - pagesToShow);
         let endPage = Math.min(totalPages, currentPage + pagesToShow);
 
         if (currentPage - pagesToShow <= 1) {
             endPage = Math.min(startPage + maxPagesToShow - 1, totalPages);
         }
 
         if (currentPage + pagesToShow >= totalPages) {
             startPage = Math.max(endPage - maxPagesToShow + 1, 1);
         }
 
         startPage = Math.max(1, startPage);
         endPage = Math.min(totalPages, endPage);
 
         let paginationHTML = '<ul class="inline-flex ml-auto items-stretch -space-x-px">';
         
         paginationHTML += '<li class="page-item">';
         paginationHTML += '<button ' + (currentPage === 1 ? ' disabled' : '') + ' class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-[#526270] bg-white border border-gray-300 hover:bg-violet-500 hover:border-y-violet-500 hover:text-white hover:text-gray-700" onclick="changePageLogs(' + (currentPage - 1) + ')">Anterior</button>';
         paginationHTML += '</li>';
 
         for (let page = startPage; page <= endPage; page++) {
             paginationHTML += '<li class="page-item' + (currentPage === page ? ' active' : '') + '">';
             paginationHTML += '<button class="flex items-center justify-center text-sm py-2 px-3 leading-tight ' + (currentPage === page ? 'border border-violet-500 bg-violet-500 text-white' : 'text-[#526270] bg-white border hover:bg-violet-500 hover:border-y-violet-500 hover:text-white hover:text-gray-700 border-gray-300 ') + '" onclick="changePageLogs(' + page + ')">' + page + '</button>';
             paginationHTML += '</li>';
         }
 
         paginationHTML += '<li class="page-item">';
         paginationHTML += '<button ' + (currentPage === totalPages ? ' disabled' : '') + ' class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-[#526270] bg-white border border-gray-300 hover:bg-violet-500 hover:border-y-violet-500 hover:text-white hover:text-gray-700" onclick="changePageLogs(' + (currentPage + 1) + ')">Siguiente</button>';
         paginationHTML += '</li>';
 
         paginationHTML += '</ul>';
 
         var temp       = document.createElement('div');
         temp.innerHTML = (paginationHTML);
 
         document.querySelector("#paginationLogs").appendChild(temp.childNodes[0]); 
     }
 
     function changePageLogs(page)
     {
         currentPageLog = page;
         getLogs(); 
         window.history.pushState({}, 'Citas - Dashboard', "{{$menu['baseURL'].$menu['route']['users']['detail']($user->id)}}/?currentPageApp="+currentPageApp+"&currentPageLog="+currentPageLog);
     }
     
    getAppointments();

</script> 
@stop