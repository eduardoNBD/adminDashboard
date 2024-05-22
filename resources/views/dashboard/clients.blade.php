@extends('layouts.dashboard',[ 'current_route'  => '/dashboard/clients'])

@section('title', 'Clients - Dashboard') 

@section('content')
<section class="">
    <div class="mx-auto px-0 md:px-4 lg:px-12"> 
        <div class="bg-white relative shadow-md rounded-lg">
            <div class="pt-4 pl-4">Clientes 
                <span id="totalClients" class="text-center md:inline-block rounded-lg text-[10px] text-white bg-gray-600 py-1 px-2 font-bold">0</span>
            </div>
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center">
                        <label htmlFor="simple-search" class="sr-only">Buscar</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-[#526270] dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fillRule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clipRule="evenodd" />
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                id="simple-search" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-400 focus:border-primary-500 block w-full pl-10 p-2" 
                                placeholder="Buscar" 
                                onkeyup="search()"
                                value="{{isset($_GET['s']) ? $_GET['s'] : ""}}"
                            />
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <a href={{$menu['baseURL'].$menu['route']['clients']['new']}} class="flex items-center justify-center text-white bg-indigo-600 hover:bg-violet-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clipRule="evenodd" fillRule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Agregar Cliente
                    </a> 
                </div>
            </div> 
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs uppercase bg-violet-500 text-white">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nombre</th>
                            <th scope="col" class="px-4 py-3 hidden md:block">Email</th> 
                            <th scope="col" class="px-4 py-3">Teléfono</th> 
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table> 
            <nav id="pagination" class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
            </nav>
        </div>
    </div>
    <div id="popup-modal" tabindex="-1" class="hidden flex bg-[#0000006b] overflow-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow ">
                <button onclick="closeModel()" type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 ">¿Estas seguro de eliminar el cliente?</h3>
                    <button  onclick="confirmDelete()" data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Si
                    </button>
                    <button onclick="closeModel()" data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">No, cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <div id="popup-detail" tabindex="-1" class="hidden flex -mt-16 md:mt-0 bg-[#0000006b] overflow-hidden fixed top-14 right-0 left-0 z-50 justify-center  w-full md:inset-0 h-full">
        <div class="relative p-4 w-full max-w-lg max-h-full">
            <div class="relative bg-white rounded-lg shadow overflow-hidden">
                <button onclick="closeModelDetail()" type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button> 
                <h2 class="bg-violet-500 text-2xl text-center text-white py-4">Detalle de usuario</h2> 
                <div id="contentDetail">
                    
                </div> 
            </div>
        </div>
    </div>
</section>
@stop

@section('scripts')
<script>  
    let currentClient = "";
    let currentPage    = {{$page}};
    let totalPages     = 0;

    function getPagination(currentPage){ 
        const s = document.querySelector("#simple-search").value;
        fetch('{{$menu['baseURL']."/clients/list?page="}}'+currentPage+'&s='+s, { 
            headers: { 
                "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },   
        })
        .then((res) => res.json())
        .then((json) => { console.log(json);
            if(json.status)
            {
                document.querySelector("#totalClients").innerHTML = json.clients.total;
                totalPages = Math.ceil(json.clients.total/json.clients.per_page);
                currentPage = json.clients.current_page;

                document.querySelector("#pagination").innerHTML = "";
                
                if(totalPages > 1){
                    setPages(currentPage, totalPages);
                }
                
                setRows(json.clients.data);
            }
            else{
                
            }
        })
        .catch((err) => console.error("error:", err)); 
    }

    function deleteClient(client){
        document.querySelector("#popup-modal").classList.remove("hidden");

        currentClient = client;
    }

    function closeModel(){
        currentClient = "";
        document.querySelector("#popup-modal").classList.add("hidden");
    }

    function confirmDelete()
    {
        fetch('{{$menu['baseURL']."/clients/delete/"}}'+currentClient, { 
            headers: { 
                "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },    
        })
        .then((res) => res.json())
        .then((json) => { console.log(json);
            if(json.status){ 
                currentClient = "";
                document.querySelector("#popup-modal").classList.add("hidden");
                getPagination(currentPage);
            }
            else{
                
            }
        })
        .catch((err) => console.error("error:", err)); 
    }

    function setRows(data){ 
        document.querySelector("table tbody").innerHTML = "";

        if(data.length){
            data.forEach(client => {  

                let rowHTML = '<tr class="border-b border-gray-200">'+
                                '<th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">'+
                                    '<a href="{{$menu['baseURL'].$menu['route']['clients']['edit']('')}}'+client.id+'" class="font-bold text-[#526270]">'+client.name+' '+client.lastname+'</a>'+
                                    '<span class="block md:hidden">'+client.email+'</span>'+
                                '</th>'+
                                '<td class="px-4 py-3 hidden md:block">'+client.email+'</td>'+
                                '<td scope="row" class="px-4 py-3">'+client.phone+'</td>'+
                                '<td class="px-4 py-3 flex items-center justify-end">'+
                                    '<div class="group relative">'+
                                        '<button id="apple-imac-27-dropdown-button" data-dropdown-toggle="apple-imac-27-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-[#526270] hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">'+
                                            '<svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">'+
                                                '<path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />'+
                                            '</svg>'+
                                        '</button>'+
                                        '<div id="apple-imac-27-dropdown" class="absolute left-[-140px] group-hover:block hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">'+
                                            '<ul class="py-1 text-sm text-gray-700" aria-labelledby="apple-imac-27-dropdown-button">'+
                                                '<li>'+
                                                    '<a href="#" class="block py-2 px-4 hover:bg-gray-100">Detalle</a>'+
                                                '</li>'+
                                                '<li>'+
                                                    '<a href="{{$menu['baseURL'].$menu['route']['clients']['edit']('')}}'+client.id+'" class="block py-2 px-4 hover:bg-gray-100">Editar</a>'+
                                                '</li>'+
                                            '</ul>'+
                                            '<div class="py-1">'+
                                                '<button onclick="deleteClient(\''+client.id+'\')" class="w-full text-left py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Eliminar</button>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</td>'+
                            '</tr>';
                
                var temp       = document.createElement('tbody');
                temp.innerHTML = rowHTML;
            
                document.querySelector("table tbody").appendChild(temp.childNodes[0]); 
            });  
        }else{
            let rowHTML = '<tr><td colspan="5"><h1 class="text-center text-3xl m-20">Sin Clientes</h1></td></tr>';
            var temp       = document.createElement('tbody');
            temp.innerHTML = rowHTML;
        
            document.querySelector("table tbody").appendChild(temp.childNodes[0]); 
        }          
    }

    function setPages(currentPage, totalPages) { 
        const pagesToShow = 2;
         
        let startPage = Math.max(1, currentPage - pagesToShow);
        let endPage = Math.min(totalPages, currentPage + pagesToShow);

        if (currentPage - pagesToShow <= 1) {
            endPage = Math.min(startPage + (pagesToShow * 2), totalPages);
        }

        if (currentPage + pagesToShow >= totalPages) {
            startPage = Math.max(endPage - (pagesToShow * 2), 1);
        }

        
        let paginationHTML = '<ul class="inline-flex ml-auto items-stretch -space-x-px">';
    
        paginationHTML += '<li class="page-item">';
        paginationHTML += '<button ' + (currentPage === 1 ? ' disabled' : '') + ' class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-[#526270] bg-white border border-gray-300 hover:bg-violet-500 hover:border-y-violet-500 hover:text-white hover:text-gray-700" onclick="changePage(' + (currentPage - 1) + ')">Anterior</button>';
        paginationHTML += '</li>';

        for (let page = startPage; page <= endPage; page++) {
            paginationHTML += '<li class="page-item' + (currentPage === page ? ' active' : '') + '">';
            paginationHTML += '<button class="flex items-center justify-center text-sm py-2 px-3 leading-tight ' + (currentPage === page ? 'border border-violet-500 bg-violet-500 text-white' : 'text-[#526270] bg-white border hover:bg-violet-500 hover:border-y-violet-500 hover:text-white hover:text-gray-700 border-gray-300 ') + '" onclick="changePage(' + page + ')">' + page + '</button>';
            paginationHTML += '</li>';
        }

        paginationHTML += '<li class="page-item">';
        paginationHTML += '<button ' + (currentPage === totalPages ? ' disabled' : '') + ' class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-[#526270] bg-white border border-gray-300 hover:bg-violet-500 hover:border-y-violet-500 hover:text-white hover:text-gray-700" onclick="changePage(' + (currentPage + 1) + ')">Siguiente</button>';
        paginationHTML += '</li>';

        paginationHTML += '</ul>';
        
        var temp       = document.createElement('div');
        temp.innerHTML = (paginationHTML);

        document.querySelector("#pagination").appendChild(temp.childNodes[0]); 
    }

    function changePage(page)
    {
        currentPage = page;
        getPagination(currentPage);
        const s = document.querySelector("#simple-search").value;
        window.history.pushState({}, 'Clientes - Dashboard', "{{$menu['baseURL'].$menu['route']['clients']['root']}}/"+currentPage+"?s="+s);
    }

    function search(){  
        const s = document.querySelector("#simple-search").value;
        window.history.pushState({}, 'Clientes - Dashboard', "{{$menu['baseURL'].$menu['route']['clients']['root']}}/"+currentPage+"?s="+s);
        getPagination(currentPage);
    }
    
    if(document.querySelector("#simple-search").value)
    {
        search();
    }

    getPagination(currentPage);
 </script>
@stop
