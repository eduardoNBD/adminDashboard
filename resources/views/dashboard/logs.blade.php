@extends('layouts.dashboard',[ 'current_route'  => '/dashboard/logs'])

@section('title', 'Registro de actividad - Dashboard') 
 
@section('content')  
<section class="">
    <div class="mx-auto px-0 md:px-4 lg:px-12"> 
        <div class="bg-white relative shadow-md sm:rounded-lg">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full">
                    <div class=" grid grid-cols-1 md:grid-cols-2">
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
                        <div class="flex items-center space-x-4"> 
                            <div class="px-2 my-2 relative group flex-1">
                                <input autocomplete="off" onchange="getPagination(currentPage)" type="date" name="begin" value="" id="begin" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " /> 
                                <label for="begin" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Fecha de inicio</label>
                            </div>
                            <div class="flex items-center text-gray-400">
                                <span>&ndash;</span>
                            </div> 
                            
                            <div class="px-2 my-2 relative group flex-1">
                                <input autocomplete="off" onchange="getPagination(currentPage)" type="date" name="end" value="" id="end" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " /> 
                                <label for="end" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Fecha final</label>
                            </div>
                        </div> 
                    </div>
                    <ul class="grid grid-cols-2 md:grid-cols-7 w-full text-sm font-medium  bg-white border  rounded-lg">
                        <li class="">
                            <div class="flex items-center ps-3">
                                <input id="appointment" name="module" type="checkbox" onchange="getPagination(currentPage)" value="appointment" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" checked>
                                <label for="appointment" class="w-full py-3 ms-2 text-sm font-medium text-gray-600">Citas</label>
                            </div>
                        </li>
                        <li class="">
                            <div class="flex items-center ps-3">
                                <input id="client" name="module" type="checkbox" onchange="getPagination(currentPage)" value="client" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" checked>
                                <label for="client" class="w-full py-3 ms-2 text-sm font-medium text-gray-600">Clientes</label>
                            </div>
                        </li>
                        <li class="">
                            <div class="flex items-center ps-3">
                                <input id="product" name="module" type="checkbox" onchange="getPagination(currentPage)" value="product" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" checked>
                                <label for="product" class="w-full py-3 ms-2 text-sm font-medium text-gray-600">Productos</label>
                            </div> 
                        </li>
                        <li class="">
                            <div class="flex items-center ps-3">
                                <input id="selling" name="module" type="checkbox" onchange="getPagination(currentPage)" value="selling" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" checked>
                                <label for="selling" class="w-full py-3 ms-2 text-sm font-medium text-gray-600">Ventas</label>
                            </div>
                        </li>
                        <li class="">
                            <div class="flex items-center ps-3">
                                <input id="profile" name="module" type="checkbox" onchange="getPagination(currentPage)" value="profile" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" checked>
                                <label for="profile" class="w-full py-3 ms-2 text-sm font-medium text-gray-600">Perfil</label>
                            </div>
                        </li>
                        <li class="">
                            <div class="flex items-center ps-3">
                                <input id="password" name="module" type="checkbox" onchange="getPagination(currentPage)" value="password" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" checked>
                                <label for="password" class="w-full py-3 ms-2 text-sm font-medium text-gray-600">Contraseñas</label>
                            </div> 
                        </li>
                        <li class="">
                            <div class="flex items-center ps-3">
                                <input id="user" name="module" type="checkbox" onchange="getPagination(currentPage)" value="user" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" checked>
                                <label for="user" class="w-full py-3 ms-2 text-sm font-medium text-gray-600">Usuarios</label>
                            </div> 
                        </li>
                    </ul> 
                </div> 
            </div> 
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="text-xs uppercase bg-violet-500 text-white">
                    <tr> 
                        <th scope="col" class="px-4 py-3">Acción</th>
                        <th scope="col" class="px-4 py-3">Registro</th>
                        <th scope="col" class="px-4 py-3 hidden md:table-cell">Usuario</th>
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
<div id="popup-detail" tabindex="-1" class="hidden flex -mt-16 md:mt-0 bg-[#0000006b] overflow-hidden fixed top-14 right-0 left-0 z-50 justify-center  w-full md:inset-0 h-full">
    <div class="relative p-4 w-full max-w-lg max-h-full">
        <div class="relative bg-white rounded-lg shadow max-h-full overflow-hidden p-2 px-4">
            <button onclick="closeModal('#popup-detail')" type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button> 
            <h2 class="text-md text-[#526270] py-4 bold">Detalle de actividad</h2> 
            <hr>
            <div id="contentDetail" class="overflow-auto max-h-[85%] overflow-x-hidden">
                
            </div> 
        </div>
    </div>
</div>
@stop

@section('scripts') 
<script>  
    let currentLog = "";
    let currentPage    = {{$page}};
    let totalPages     = 0;
    let fieldsProduct = {
        productname: "Nombre de producto", 
        productkey:"Clave", 
        productprice: "Precio", 
        productqty: "Cantidad", 
        productimage: "imagen",

        servicename: "Nombre de servicio", 
        servicekey:"Clave", 
        serviceprice: "Precio",  

        username: "Nombre",
        userlastname: "Apellido",
        userusername: "Nombre de usuario",
        useremail: "E-mail",
        userphone: "Teléfono",
        userrole: "Rol de usuario",

        profilename: "Nombre",
        profilelastname: "Apellido",  
        profilephone: "Teléfono", 

        clientname: "Nombre",
        clientlastname: "Apellido",
        clientemail: "E-mail",
        clientphone: "Teléfono",

        appointmentclient_id: "Cliente",
        appointmentservice_id: "Servicio",
        appointmentdate: "Fecha",
        appointmentbegin: "Hora de inicio",
        appointmentend: "Hora de fin",
        appointmentuser_id: "Atendido por",
        appointmentnotes: "Notas de cita",

        sellingappointment: "Cita",
        sellingclient: "Cliente",
        sellingnotes: "Notas de venta",
        sellingsubtotal: "Sub Total",
        sellingstatus: "Estatus",
        
    };

    function getPagination(currentPage){ 
        let rangeDates = ""

        if(document.querySelector("#begin").value != "" && document.querySelector("#end").value != ""){
            rangeDates = "&start="+document.querySelector("#begin").value+"&end="+document.querySelector("#end").value;
        }

        const modules = Array.from(document.querySelectorAll("[name='module']:checked")).map(checked => { return "modules[]="+checked.value }).join("&");
        const s = document.querySelector("#simple-search").value;
        fetch('{{$menu['baseURL']."/logs/list?page="}}'+currentPage+'&s='+s+rangeDates+"&"+modules, { 
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
        .then((json) => {  
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

    function showDetail(log){  console.log(log);
        let action = log.action.split("_")[1];
        let rowHTML = '<div>'+
                            '<section class="my-2 clear-both px-3">'+
                                (reformatDate(log.created_at).split(" ").map((item,index) => { 
                                    return '<span class="'+(index ? "float-right" : "")+' inline-block rounded-lg text-sm text-gray-400">'+item+'</span>'
                                }).join(""))+ 
                            '</section> '+
                            '<section class="my-2 clear-both px-3">'+
                                '<h2 class="text-xl text-[#526270] bold text-center clear-both">'+log.detail.actionName+' '+log.detail.name+'</h2> '+
                                (log.user != "{{Auth::id()}}" ? '<a href="{{$menu['baseURL'].$menu['route']['users']['edit']('')}}'+log.user+'" class="p-2 block text-center">'+log.fullname+'</a>' : "")+
                            '</section>'+ 
                            (log.detail.prevData ? 
                                ('<section class="my-2 px-3 grid grid-cols-2">'+
                                    '<span class="bg-gray-200 px-2 py-3">Valores Anteriores</span><span class="bg-gray-200 px-2 py-3">Valores nuevos</span>'+
                                    (Object.entries(log.detail.prevData).filter(element => element[0] != "detail").map((value) => { 
                                                if(typeof value[1] == "object" && value[1] != null){ 
                                                    value[1] = getDataByObject(value[1]);
                                                }
                                                
                                                if(typeof log.detail.newData[value[0]] == "object"){
                                                    log.detail.newData[value[0]] = getDataByObject(log.detail.newData[value[0]]);
                                                }
                                                return '<span class="px-3 text-sm"><strong>'+fieldsProduct[action+value[0]]+'</strong> : <br>'+value[1]+'</span>'+'<span class="px-3 text-sm"><strong>'+fieldsProduct[action+value[0]]+'</strong> : <br>'+log.detail.newData[value[0]]+'</span>' 
                                           
                                        }).join("<hr class='col-span-2 my-2'>")
                                    )+ 
                                    (log.detail.prevData.detail != undefined ?
                                        '<div class="bg-gray-100 pt-3 pb-1 col-span-2 mt-5"> '+ 
                                            '<span class="px-4 text-gray-400">Productos y servicios anteriores</span>'+
                                            (log.detail.prevData.detail.types.map( (row, index) => {
                                                return '<section class="px-4 clear-both">'+
                                                    '<span>'+log.detail.prevData.detail.qty[index]+' '+log.detail.prevData.detail.items[index].name+'<br><span class="text-sm">'+log.detail.prevData.detail.users[index].username+'</span></span>'+
                                                    '<span class="float-right">$ '+parseFloat(log.detail.prevData.detail.price[index]).toFixed(2)+'</span>'+
                                                '</section>';
                                            }).join(""))+ 
                                        '</div> '
                                        : ""
                                    )+ 
                                    (log.detail.newData.detail != undefined ?
                                        '<div class="bg-gray-100 pt-3 pb-1 col-span-2"> '+ 
                                            '<span class="px-4 text-gray-400">Productos y servicios nuevos</span>'+
                                            (log.detail.newData.detail.types.map( (row, index) => {
                                                return '<section class="px-4 clear-both">'+
                                                    '<span>'+log.detail.newData.detail.qty[index]+' '+log.detail.newData.detail.items[index].name+'<br><span class="text-sm">'+log.detail.newData.detail.users[index].username+'</span></span>'+
                                                    '<span class="float-right">$ '+parseFloat(log.detail.newData.detail.price[index]).toFixed(2)+'</span>'+
                                                '</section>';
                                            }).join(""))+ 
                                        '</div> '
                                        : ""
                                    )+ 
                                '</section>'
                                )
                                : ''  
                            )+
                            (log.detail.data ? 
                                ('<section class="my-2 px-3">'+
                                    '<span class="bg-gray-200 px-2 py-3 block mb-2">Valores</span>'+
                                    (Object.entries(log.detail.data).filter(element => element[0] != "detail").map((value) => { 
                                                if(typeof value[1] == "object" && value[1] != null){
                                                    value[1] = getDataByObject(value[1]);console.log(value[0]); 
                                                }

                                                return '<span class="px-3 text-sm"><strong>'+fieldsProduct[action+value[0]]+'</strong> : '+value[1]+'</span>' 
                                           
                                        }).join("<hr class='col-span-2 my-2'>")
                                    )+  
                                '</section>'
                                )
                                : ''  
                            )+
                            (log.detail.data?.detail != undefined ?
                                '<div class="bg-gray-100 pt-3 pb-1 col-span-2"> '+ 
                                    '<span class="px-4 text-gray-400">Productos y servicios</span>'+
                                    (log.detail.data.detail.types.map( (row, index) => {
                                        return '<section class="px-4 clear-both">'+
                                            '<span>'+log.detail.data.detail.qty[index]+' '+log.detail.data.detail.items[index].name+'<br><span class="text-sm">'+log.detail.data.detail.users[index].username+'</span></span>'+
                                            '<span class="float-right">$ '+parseFloat(log.detail.data.detail.price[index]).toFixed(2)+'</span>'+
                                        '</section>';
                                    }).join(""))+ 
                                '</div> '
                                : ""
                            )+ 
                      '</div>'; 
        
        document.querySelector("#contentDetail").innerHTML = rowHTML; 
        document.querySelector("#popup-detail").classList.remove("hidden");
    } 

    function setRows(data){ 
        document.querySelector("table tbody").innerHTML = "";

        if(data.length){
            data.forEach(log => { 
                let rowHTML = '<tr class="border-b border-gray-200">'+
                                '<td scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">'+log.detail.actionName+'</td>'+ 
                                '<td scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="{{$menu['baseURL']}}/dashboard/'+(log.action.split("_")[1])+'s/'+(log.action.split("_")[1])+'/'+log.detail.id+'">'+log.detail.name+'</a></td>'+
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
            let rowHTML = '<tr><td colspan="5"><h1 class="text-center text-3xl m-20">Sin Registro de actividades</h1></td></tr>';
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
    
    function getDataByObject(objValue){console.log("objValue",objValue);
        if(objValue.typeObj == "users"){
            return `<a href="{{$menu['baseURL'].$menu['route']['users']['edit']('')}}/${objValue.id}">
                        ${objValue.name} ${objValue.lastname}
                    </a>`;
        }

        if(objValue.typeObj == "clients"){
            return `<a href="{{$menu['baseURL'].$menu['route']['clients']['edit']('')}}/${objValue.id}">
                        ${objValue.name} ${objValue.lastname}
                    </a>`;
        }

        if(objValue.typeObj == "services"){
            return `<a href="{{$menu['baseURL'].$menu['route']['services']['edit']('')}}/${objValue.id}">
                        ${objValue.name} 
                    </a>`;
        }

        if(objValue.typeObj == "appointments"){
            return `<a href="{{$menu['baseURL'].$menu['route']['appointments']['edit']('')}}/${objValue.id}">
                       #${objValue.no} 
                    </a>`;
        }

        return objValue.typeObj;
    }

    if(document.querySelector("#simple-search").value)
    {
        search();
    }

    getPagination(currentPage);
</script>
@stop


