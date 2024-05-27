@extends('layouts.dashboard',[ 'current_route'  => '/dashboard/users'])

@section('title', 'Users - Dashboard') 

@section('content')
<section class="">
    <div class="mx-auto px-0 md:px-4 lg:px-12"> 
        <div class="bg-white relative shadow-md rounded-lg">
            <div class="pt-4 pl-4">Usuarios 
                <span id="totalUsers" class="text-center md:inline-block rounded-lg text-[10px] text-white bg-gray-600 py-1 px-2 font-bold">0</span>
            </div>
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center">
                        <label for="simple-search" class="sr-only">Buscar</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-[#526270]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
                    <ul class="items-center w-full text-sm font-medium  bg-white border  rounded-lg flex">
                        <li class="w-full ">
                            <div class="flex items-center ps-3">
                                <input id="cancel" name="status" type="checkbox" onchange="getPagination(currentPage)" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="cancel" class="w-full py-3 ms-2 text-sm font-medium text-gray-600">Eliminado</label>
                            </div>
                        </li>
                        <li class="w-full ">
                            <div class="flex items-center ps-3">
                                <input id="pending" name="status" type="checkbox" onchange="getPagination(currentPage)" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" checked>
                                <label for="pending" class="w-full py-3 ms-2 text-sm font-medium text-gray-600">Disponible</label>
                            </div>
                        </li> 
                    </ul>
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <a href="{{$menu['baseURL'].$menu['route']['users']['new']}}" class="flex items-center justify-center text-white bg-indigo-600 hover:bg-violet-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clipRule="evenodd" fillRule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Agregar Usuario
                    </a> 
                </div>
            </div> 
            <hr>
            <section id="userList" class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 px-3 md:p-4">  
            </section>
            <nav id="pagination" class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                         
            </nav>
        </div> 
    </div>
</section>
<div id="popup-modal" tabindex="-1" class="hidden flex bg-[#0000006b] overflow-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow ">
            <button onclick="closeModal('#popup-modal')" type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 ">¿Estas seguro de eliminar el usuario?</h3>
                <button  onclick="confirmDelete()"  data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Si
                </button>
                <button onclick="closeModal('#popup-modal')" data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">No, cancelar</button>
            </div>
        </div>
    </div>
</div>
<div id="popup-recovery" tabindex="-1" class="hidden flex bg-[#0000006b] overflow-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow ">
            <button onclick="closeModal('#popup-recovery')" type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 ">¿Estas seguro de habilitar el usuario?</h3>
                <button  onclick="confirmRecover()"  data-modal-hide="popup-modal" type="button" class="text-white bg-emerald-600 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Si 
                </button>
                <button onclick="closeModal('#popup-recovery')" data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">No, cancelar</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
    <script>  
        let currentUser = "";
        let currentPage = {{$page}};
        let totalPages  = 0;
        const gradients = [
            "bg-gradient-to-r from-cyan-500 to-blue-500",
            "bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500",
            "bg-gradient-to-r from-indigo-500 from-10% via-sky-500 via-30% to-emerald-500 to-90%",
            "bg-gradient-to-r from-green-400 to-blue-500",
        ];

        const roles = <?=json_encode($roles); ?>;

        function getPagination(currentPage){ 
            const status = Array.from(document.querySelectorAll("[name='status']:checked")).map(checked => { return "status[]="+checked.value }).join("&");
            const s = document.querySelector("#simple-search").value;
            fetch('{{$menu['baseURL']."/users/list?page="}}'+currentPage+'&s='+s+'&'+status, { 
                headers: { 
                    "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json', 
                },   
            })
            .then((res) => res.json())
            .then((json) => { 
                if(json.status)
                {
                    document.querySelector("#totalUsers").innerHTML = json.users.total;
                    totalPages = Math.ceil(json.users.total/json.users.per_page);
                    currentPage = json.users.current_page;

                    document.querySelector("#pagination").innerHTML = "";
                    
                    if(totalPages > 1){
                        setPages(currentPage, totalPages);
                    }
                    
                    setRows(json.users.data);
                }
                else{
                    
                }
            })
            .catch((err) => console.error("error:", err)); 
        }

        function deleteUser(user){
            document.querySelector("#popup-modal").classList.remove("hidden");

            currentUser = user;
        }

        function recoveryUser(user){
            document.querySelector("#popup-recovery").classList.remove("hidden");

            currentUser = user;
        }

        function closeModal(id){
            currentUser = "";
            document.querySelector(id).classList.add("hidden");
        }

        function detailUser(user){
            console.log(user);
        }

        function confirmDelete()
        {
            fetch('{{$menu['baseURL']."/users/delete/"}}'+currentUser, { 
                headers: { 
                    "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },   
                credentials: 'include'
            })
            .then((res) => { 
                if (!res.ok) { 
                    location.href = "{{$menu['baseURL'].$menu['route']['dashboard']['root']}}";
                }

                return res.json();
            })
            .then((json) => { 
                if(json.status){ 
                    currentUser = "";
                    document.querySelector("#popup-modal").classList.add("hidden");
                    getPagination(currentPage);
                }
                else{
                    
                }
            })
            .catch((err) => console.error("error:", err)); 
        }

        function confirmRecover(){
            fetch('{{$menu['baseURL']."/users/recover/"}}'+currentUser, { 
                headers: { 
                    "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json', 
                },  
            })
            .then((res) => { 
                if (!res.ok) { 
                    //location.href = baseURLDashboard;
                }

                return res.json();
            })
            .then((json) => { 
                if(json.status){ 
                    currentService = "";
                    document.querySelector("#popup-recovery").classList.add("hidden");
                    getPagination(currentPage);
                }
                else{
                    
                }
            })
            .catch((err) => console.error("error:", err)); 
        }

        function setRows(data){ 
            document.querySelector("#userList").innerHTML = "";

            if(data.length){
                data.forEach(user => {
                    let rowHTML =   '<div class="bg-white shadow-md rounded-lg overflow-hidden">'+
                                        '<div class="'+gradients[Math.ceil(Math.random()*(gradients.length-1))]+' py-16" ></div>'+
                                        '<div class="bg-white p-2">'+
                                            '<div  class="bg-user-bg bg-no-repeat bg-center">'+
                                                (user.status == 0 ? '<small class="float-right text-xs text-white bg-red-600 rounded-lg py-1 px-2"><i>Eliminado</i></small>' : '')+
                                                '<div class="rounded-full w-24 h-24 pt-6 -mt-14 -mb-4 m-auto text-5xl text-center text-[#555555]">'+user.username[0]+'</div>'+
                                            '</div>'+
                                            '<div class="text-center text-[#777777] mb-4">'+user.username+'</div>'+
                                            '<div class="text-center clear-both">'+
                                                '<strong>'+user.name+' '+user.lastname+'</strong>'+
                                            '</div>'+
                                            '<div class="text-center text-[#777777] mb-4">'+roles[user.role]+'</div>'+
                                            '<hr />'+
                                            '<div class="flex py-4">'+
                                                '<div class="text-center flex-grow"><small class="block text-center text-[#777777]"><i>E-mail</i></small>'+user.email+'</div>'+ 
                                                '<div class="text-center flex-grow"><small class="block text-center text-[#777777]"><i>Teléfono</i></small>'+user.phone+'</div>'+ 
                                            '</div>'+ 
                                            '<hr />'+
                                            '<div class="pt-3">'+
                                                '<a href="{{$menu['baseURL'].$menu['route']['users']['detail']('')}}'+user.id+'" class="inline-block text-gray-700" title="Ver más">'+
                                                    '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>'+
                                                '</a>'+
                                                (user.status ?
                                                    '<button  onclick="deleteUser(\''+user.id+'\')" class="float-right text-red-700" title="Eliminar">'+
                                                        '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  strokeW-wdth="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>'+
                                                    '</button>'+
                                                    '<a href="{{$menu['baseURL'].$menu['route']['users']['edit']('')}}'+user.id+'"  class="float-right inline-block text-blue-600" title="Editar">'+
                                                        '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  float-right icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>'+
                                                    '</a>'
                                                    :
                                                    '<button  onclick="recoveryUser(\''+user.id+'\')" class="float-right text-emerald-800" title="Recuperar">'+
                                                        '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-refresh"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>'+
                                                    '</button>'
                                                )+ 
                                                '<div class="clear-both"></div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>';
                                
                    var temp       = document.createElement('div');
                    temp.innerHTML = rowHTML;
                                                
                    document.querySelector("#userList").appendChild(temp.childNodes[0]); 
                });  
            }else{
                let rowHTML = '<h1 class="text-center text-3xl m-20 col-span-3">Sin Usuarios</h1>';
                var temp       = document.createElement('tbody');
                temp.innerHTML = rowHTML;
            
                document.querySelector("#userList").appendChild(temp.childNodes[0]); 
            }          
        }

        function setPages(currentPage, totalPages) { 
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
            window.history.pushState({}, 'Users - Dashboard', "{{$menu['baseURL'].$menu['route']['users']['root']}}/"+currentPage+"?s="+s);
        }

        function search(){  
            const s = document.querySelector("#simple-search").value;
            window.history.pushState({}, 'Users - Dashboard', "{{$menu['baseURL'].$menu['route']['users']['root']}}/"+currentPage+"?s="+s);
            getPagination(currentPage);
        }
        
        if(document.querySelector("#simple-search").value)
        {
            search();
        }

        getPagination(currentPage);
    </script>
@stop
