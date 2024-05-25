@extends('layouts.dashboard',[ 'current_route'  => '/dashboard/logs'])

@section('title', 'Registro de actividad - Dashboard') 
 
@section('content')  
<section class="">
    <div class="mx-auto px-0 md:px-4 lg:px-12"> 
        <div class="bg-white relative shadow-md sm:rounded-lg">
            
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
            </div> 
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="text-xs uppercase bg-violet-500 text-white">
                    <tr> 
                        <th scope="col" class="px-4 py-3">Acción</th>
                        <th scope="col" class="px-4 py-3">Usuario</th>
                        <th scope="col" class="px-4 py-3">Fecha y hora</th>  
                        <th scope="col" class="px-4 py-3"><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table> 
            <nav id="pagination" class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">

            </nav> 
        </div>
    </div>
</section>
@stop

@section('scripts') 
<script>  
    let currentLog = "";
    let currentPage    = {{$page}};
    let totalPages     = 0;

    function getPagination(currentPage){ 
        const s = document.querySelector("#simple-search").value;
        fetch('{{$menu['baseURL']."/logs/list?page="}}'+currentPage+'&s='+s, { 
            headers: { 
                "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json', 
            },   
            credentials: 'include'
        })
        .then((res) => { 
            if (!res.ok) { 
                //location.href = "{{$menu['baseURL'].$menu['route']['dashboard']['root']}}";
            }

            return res.json();
        })
        .then((json) => {  console.log(json);
            if(json.status)
            { 
                totalPages = Math.ceil(json.logs.total/json.logs.per_page);
                currentPage = json.logs.current_page;
                

                document.querySelector("#pagination").innerHTML = "";

                if(totalPages > 1){
                    setPages(currentPage, totalPages);
                }

                setRows(json.logs.data);
            }
            else{
                
            }
        })
        .catch((err) => console.error("error:", err)); 
    } 

    function closeModal(id){
        currentLog = "";
        document.querySelector(id).classList.add("hidden");
    }

    function showDetail(selling){ 
        let detail  = JSON.parse(selling.detail); 
      
        let rowHTML = '<div>'+
                        '<section class="my-2 clear-both px-3">'+
                            (reformatDate(selling.updated_at).split(" ").map((item,index) => { 
                                return '<span class="'+(index ? "float-right" : "")+' inline-block rounded-lg text-sm text-gray-400">'+item+'</span>'
                            }).join(""))+ 
                        '</section> '+
                        '<hr> '+ 
                        '<section class="my-2 px-8">'+
                            '<span class="text-gray-400">Cliente</span>'+
                            '<span class="float-right">'+(selling.client_id != null ? selling.client : "Sin Cliente")+'</span>'+
                        '</section> '+ 
                        '<div class="bg-gray-100 pt-3 pb-1 px-3"> '+ 
                            '<span class="text-gray-400">Productos y servicios</span>'+
                            (detail.types.map( (row, index) => {
                                item = row == "Servicios" ? services.filter(service => service.id == detail.items[index])[0] : products.filter(product => product.id == detail.items[index])[0];
                                return '<section class=" pl-10 my-2 clear-both">'+
                                    '<span>'+detail.qty[index]+' '+item.name+'</span>'+
                                    '<span class="float-right">$ '+parseFloat(detail.price[index]).toFixed(2)+'</span>'+
                                '</section>';
                            }).join(""))+ 
                        '</div> '+ 
                        '<section class="my-2 px-3 pb-4">'+
                            '<span class="text-gray-400">Total</span>'+
                            '<span class="float-right">$ '+selling.subtotal.toFixed(2)+'</span>'+
                        '</section></div>'; 
        
        document.querySelector("#contentDetail").innerHTML = rowHTML; 
        document.querySelector("#popup-detail").classList.remove("hidden");
    } 

    function setRows(data){ 
        document.querySelector("table tbody").innerHTML = "";

        if(data.length){
            data.forEach(log => { 
                let rowHTML = '<tr class="border-b border-gray-200">'+
                                '<td scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">'+log.detail.actionName+'</td>'+
                                '<td scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell">'+log.fullname+'</td>'+
                                '<td class="px-4 py-3 "><span class="block text-center md:inline-block rounded-lg text-[10px] text-white bg-indigo-600 py-1 px-2 font-bold">'+reformatDate(log.created_at)+'</span></td>'+
                                '<td class="px-4 py-3 flex items-center justify-end">'+
                                    '<div class="group relative">'+
                                        '<button class="inline-flex items-center p-0.5 text-sm font-medium text-center text-[#526270] hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">'+
                                            '<svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">'+
                                                '<path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />'+
                                            '</svg>'+
                                        '</button>'+
                                        '<div class="absolute left-[-173px] top-[-6px] group-hover:block hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">'+
                                            '<ul class="py-1 text-sm text-gray-700">'+
                                                '<li>'+
                                                    '<button onclick=\'showDetail('+JSON.stringify(log)+')\' class="w-full text-left py-2 px-4 hover:bg-gray-100">Detalle</button>'+
                                                '</li>'+
                                            '</ul>'+ 
                                        '</div>'+
                                    '</div>'+
                                '</td>'+
                            '</tr>';
                
                var temp       = document.createElement('tbody');
                temp.innerHTML = rowHTML;
            
                document.querySelector("table tbody").appendChild(temp.childNodes[0]); 
            });      
        }else{
            let rowHTML = '<tr><td colspan="5"><h1 class="text-center text-3xl m-20">Sin Citas</h1></td></tr>';
            var temp       = document.createElement('tbody');
            temp.innerHTML = rowHTML;
        
            document.querySelector("table tbody").appendChild(temp.childNodes[0]); 
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
        window.history.pushState({}, 'Citas - Dashboard', "{{$menu['baseURL'].$menu['route']['logs']['root']}}/"+currentPage+"?s="+s);
    }

    function search(){  
        const s = document.querySelector("#simple-search").value;
        window.history.pushState({}, 'Citas - Dashboard', "{{$menu['baseURL'].$menu['route']['logs']['root']}}/"+currentPage+"?s="+s);
        getPagination(currentPage);
    }
    
    if(document.querySelector("#simple-search").value)
    {
        search();
    }

    getPagination(currentPage);
</script>
@stop


