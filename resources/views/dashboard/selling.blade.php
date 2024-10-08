@extends('layouts.dashboard',[ 'current_route'  => '/dashboard/sellings'])

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
<section class="bg-white px-0 md:px-5 pt-5 pb-5 w-full lg:w-5/6 rounded-lg m-auto mt-5">
    <h1 class="text-center text-2xl font-bold text-[#526270] pb-4">{{$title}}</h1>
    <hr />
    <form onsubmit="submitForm('{{$id ? $menu['baseURL']."/sellings/update/".$id : $menu['baseURL']."/sellings/create" }}','{{$menu['baseURL'].$menu['route']['sellings']['root']}}')" action="#" method="POST">
        @csrf <!-- {{ csrf_field() }} -->
        <div class="grid grid-cols-1 gap-4 md:gap-8 md:grid-cols-2 m-2 md:m-10 md:mt-6"> 
            <div class="col-span-2 md:col-span-1">
                <div class="autocomplete relative group">
                    <input type="text" autocomplete="off" name="appointments" id="appointments" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-[1px] border-[#526270] appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="appointments" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Citas</label>
                </div>
            </div>  
            <div class="col-span-2 md:col-span-1">
                <div class="autocomplete relative group">
                    <input type="text" autocomplete="off" name="clients" id="clients" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-[1px] border-[#526270] appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="clients" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Clientes</label>
                </div>
            </div>  
            <div class="col-span-2 md:col-span-1  mt-[18px]">
                <div class="relative z-0 group">
                    <input type="text" value="{{$selling->notes}}" autocomplete="off" name="notes" id="notes" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-[1px] border-[#526270] appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="notes" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Notas de venta</label>
                </div>
            </div> 
            <h1 class="col-span-2 text-2xl font-bold text-[#526270]">Detalle</h1> 
            <div class="col-span-2 border-[1px] border-gray-200 rounded-lg p-2 ">                            
                <div id="detailContent">
                </div>  
                <div class="grid grid-cols-5 mt-10"> 
                    <div class="col-span-4 ml-auto">Total:</div>
                    <div id="total" class="border-t-2 text-right pr-4">0</div>
                </div> 
            </div> 
            <div class="col-span-2 mt-4 text-right">
                <button type="button" class="px-6 py-2 rounded-lg bg-indigo-700 text-white" onClick="handleAddItem()">Agregar producto o servicio</button>
            </div>
            <hr class="col-span-2 mt-4" />
            <div class="col-span-2 mt-4 text-right">
                <label id="errorMessage" class="text-red-600 text-left block"></label> 
                <input name="sell" type="submit" class="bg-violet-600 text-white border-violet-600 border-2 rounded-md px-10 py-1 mr-2" value="Cobrar" />
                <input name="save" type="submit" class="bg-violet-600 text-white border-violet-600 border-2 rounded-md px-10 py-1" value="Guardar" />
            </div>
        </div>
    </form>
</section>
@if (!count($services) && !count($products))
    <div id="popup-modal" tabindex="-1" class="flex bg-[#0000006b] overflow-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow "> 
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 ">No hay servicios ni productos agregdos</h3>
                    <a href="{{$menu['baseURL'].$menu['route']['services']['new']}}" class="text-white bg-emerald-600 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Crear Servicio
                    </a>
                    <a href="{{$menu['baseURL'].$menu['route']['products']['new']}}" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Crear producto</a>
                </div>
            </div>
        </div>
    </div>
@endif
@stop

@section('scripts')
<script>
    const appointments  = {!! json_encode($appointments)!!};
    const clients  = {!! json_encode($clients)!!};
    const services = {!! json_encode($services)!!};
    const products = {!! json_encode($products)!!};
    const users    = {!! json_encode($users)!!};
    const types    = [{name:"Productos"},{name:"Servicios"}];
    const selling  = {!! json_encode($selling) !!};
    const newRow = '<div class="overflow-x-auto overflow-y-none h-[200px] item-row">'+
                        '<div class="grid grid-cols-4 gap-4 min-w-[700px]">'+
                            '<div class="col-span-4">'+
                                '<button type="button" onClick="handleDeleteItem()" class="text-[#526270] float-right mt-3">'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12"/><path d="M6 6l12 12"/></svg>'+
                                '</button>'+
                            '</div>'+
                            '<div class="pl-1">'+
                                '<div class="autocomplete relative group">'+
                                    '<input value="'+types[1].name+'" data-object=\''+JSON.stringify(types[1]).trim()+'\' autocomplete="off" type="text" name="type[]" class="types block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-[1px] border-[#526270] appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />'+
                                    '<label for="type" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tipo</label>'+
                                '</div>'+
                            '</div>'+
                            '<div>'+
                                '<div class="autocomplete relative group">'+
                                    '<input type="text" name="services[]" autocomplete="off" class="services block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-[1px] border-[#526270] appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />'+
                                    '<label for="services" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Servicios</label>'+
                                '</div>'+
                                '<div class="autocomplete relative group" style="display:none">'+
                                    '<input type="text" name="products[]" autocomplete="off" class="products block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-[1px] border-[#526270] appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />'+
                                    '<label for="products" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Productos</label>'+
                                '</div>'+
                            '</div>'+
                            '<div class="flex gap-1">'+
                                '<div class="relative z-0 mt-1 group">'+
                                    '<input readOnly  value="0" type="text"  name="price[]" class="prices block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-[1px] border-[#526270] appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />'+
                                    '<label class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Precio</label>'+
                                '</div>'+
                                '<div class="relative z-0 mt-1 group">'+
                                    '<input min="1" onchange="changeQty()" value="1" type="number" name="qty[]" class="qty block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-[1px] border-[#526270] appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />'+
                                    '<label class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Cantidad</label>'+
                                '</div>'+
                            '</div>'+
                            '<div>'+
                                '<div class="relative z-0 mt-1 group">'+
                                    '<input type="text" name="users[]" autocomplete="off" class="users block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-[1px] border-[#526270] appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />'+
                                    '<label class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Usuario</label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<hr/>'+
                    '</div>';
        
    function autocomplete(inp, arr, callback) { 
        var currentFocus; 
        
        inp.addEventListener("input", (e) => {

            if(inp.dataset.object){
                if(JSON.parse(inp.dataset.object).name.trim() != inp.value.trim()){
                    inp.dataset.object = "";
                }
            }
            var a, b, i, indexed = 0,exist = false, val = e.target.value; 

            closeAllLists();

            if (!val) { 
                inp.dispatchEvent(new Event("click"));    
                return false;
            }

            currentFocus = -1;
           
            a = document.createElement("DIV");
            a.setAttribute("id", e.target.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
             
            e.target.parentNode.appendChild(a);
             
            for (i = 0; i < arr.length; i++) {
             
                if (arr[i].name.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    if(!exist){
                        exist = true;
                    }

                    b = document.createElement("DIV"); 
                    b.innerHTML = "<strong>" + arr[i].name.substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].name.substr(val.length); 
                    b.innerHTML += "<input type='hidden' value='"+arr[i].name+"'  data-object='" + JSON.stringify(arr[i]) + "'>"; 
                    b.addEventListener("click", (e) => {
                        inp.value = event.currentTarget.getElementsByTagName("input")[0].value; 
                        inp.dataset.object = event.currentTarget.getElementsByTagName("input")[0].dataset.object;
                         
                        if(callback)callback(inp);
                        closeAllLists();
                        calcTotal();
                    });
                    a.appendChild(b);

                    if(indexed == 1)
                    {
                        break;
                    }

                    indexed++;
                }
            }

            if(!exist){
                b = document.createElement("DIV"); 
                b.innerHTML = "Elemento no encontrado"; 
                a.appendChild(b);
            } 
        });

        inp.addEventListener("click", (e) => { 
            e.stopPropagation();
            var a, b, i, exist = false, val = e.target.value; 

            closeAllLists(); 
           
            a = document.createElement("DIV");
            a.setAttribute("id", e.target.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
             
            e.target.parentNode.appendChild(a);
             
            for (i = 0; i < arr.length; i++) {

                if(i == 2)
                {
                    break;
                }
                
                if (!val) { 
                    b = document.createElement("DIV"); 
                    b.innerHTML = "<strong>" + arr[i].name + "</strong>"; 
                    b.innerHTML += "<input type='hidden' value='" + arr[i].name + "'  data-object='" + JSON.stringify(arr[i]) + "'>"; 

                    b.addEventListener("click", (e) => { 
                        inp.value = event.currentTarget.getElementsByTagName("input")[0].value; 
                        inp.dataset.object = event.currentTarget.getElementsByTagName("input")[0].dataset.object;

                        if(callback)callback(inp);
                        closeAllLists();
                        calcTotal();
                    });
                    a.appendChild(b);
                }
                else
                {
                    if (arr[i].name.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        if(!exist){
                            exist = true;
                        }

                        b = document.createElement("DIV"); 
                        b.innerHTML = "<strong>" + arr[i].name.substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].name.substr(val.length); 
                        b.innerHTML += "<input type='hidden' value='" + arr[i].name + "' data-object='" + JSON.stringify(arr[i]) + "'>"; 

                        b.addEventListener("click", (e) => { 
                            inp.value = event.target.getElementsByTagName("input")[0].value; 
                            inp.dataset.object = event.target.getElementsByTagName("input")[0].dataset.object;
                             
                            if(callback)callback(inp);
                            closeAllLists();
                            calcTotal();
                        });
                        a.appendChild(b);
                    }
                }
                
            }
        });
        
        inp.addEventListener("focusout", (event) => {
            event.target.value = event.target.dataset.object ? event.target.value : "";
        });

        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
          
                currentFocus++;
                addActive(x);
            } else if (e.keyCode == 38) {
                currentFocus--; 
                addActive(x);
            } else if (e.keyCode == 13) {
            
                e.preventDefault();
                if (currentFocus > -1) { 
                    if (x) x[currentFocus].click();
                }
            }
        });

        function addActive(x) {
            if (!x) return false;
            
            removeActive(x);

            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
           
            x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) { 
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }

        function closeAllLists(elmnt) { 
            var x = document.getElementsByClassName("autocomplete-items");

            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
         
        document.addEventListener("click", function (e) {  
            closeAllLists(e.target);
        });
    }

    async function handleAddItem(callback){
        var temp       = document.createElement('div');
        temp.innerHTML = (newRow);

        document.querySelector("#detailContent").appendChild(temp.childNodes[0]);

        var typeNode = getLastElement(".types");
        var servNode = getLastElement(".services");
        var prodNode = getLastElement(".products");
        var userNode = getLastElement(".users");

        autocomplete(servNode, services, (input) => {  
            input.parentNode.parentNode.nextSibling.querySelector("input").value = JSON.parse(input.dataset.object).price;
        });

        autocomplete(prodNode, products, (input) => { 
            let productAdd = document.querySelectorAll('.products[data-object=\''+input.dataset.object+'\']');
          
            if(productAdd.length > 1 ){
                let valueNew = input.parentNode.parentNode.nextSibling.querySelector(".qty").value;
                let valueOld = productAdd[0].parentNode.parentNode.nextSibling.querySelector(".qty").value;

                productAdd[0].parentNode.parentNode.nextSibling.querySelector(".qty").value = parseInt(valueOld)+parseInt(valueNew);
                input.parentElement.parentElement.parentElement.parentElement.querySelector(".col-span-4 button").click()
            }else{
                input.parentNode.parentNode.nextSibling.querySelector("input").value = JSON.parse(input.dataset.object).price;
            } 
        });

        autocomplete(userNode, users);
        autocomplete(typeNode, types, (input) => {  
            var row = event.currentTarget.parentNode.parentNode.parentNode.parentNode;
             
            if(input.value == "Servicios")
            {
                row.childNodes[2].childNodes[0].style.display = "inherit";
                row.childNodes[2].childNodes[1].style.display = "none"; 
            }
            else
            {
                row.childNodes[2].childNodes[0].style.display = "none";
                row.childNodes[2].childNodes[1].style.display = "inherit"; 
            }
        });

        if(callback) await callback();
    }

    function calcTotal(){
        let allRows = document.querySelectorAll("#detailContent .item-row");
        let total   = 0;

        allRows.forEach(element => {
            const inputsArr = element.querySelectorAll("input");
 
            total+= inputsArr[3].value * inputsArr[4].value;
        });

        document.querySelector("#total").innerHTML = "$ "+parseFloat(total).toFixed(2);
    }

    function changeQty(){
        if(event.target.value == "" || event.target.value == "0"){
            event.target.value = 1;
        }

        calcTotal();
    }

    function handleDeleteItem(){
        event.currentTarget.parentNode.parentNode.parentNode.remove();
    }

    autocomplete(document.querySelector("#clients"), clients);
    autocomplete(document.querySelector("#appointments"), appointments, (input) => {  
        let json = JSON.parse(input.dataset.object);
        
        if(json.client_id){
            const client = clients.filter(client => client.id == json.client_id);

            let eClient = document.querySelector("#clients");
            eClient.dataset.object = JSON.stringify(client[0]); 
            eClient.value = client[0].name;

            document.querySelector("#notes").value = json.notes;
        }

        if(json.service_id){ 
            const service = services.filter(service => service.id == json.service_id);

            handleAddItem(()=> {  
                var serviceNode = getLastElement(".services");
                var priceNode   = getLastElement(".prices");

                serviceNode.dataset.object = JSON.stringify(service[0]);
                serviceNode.value = service[0].name;
                priceNode.value = service[0].price;
                
                if(json.user_id){
                    const user = users.filter(user => user.id == json.user_id);
                    var userNode = getLastElement(".users");

                    userNode.dataset.object = JSON.stringify(user[0]);
                    userNode.value = user[0].name;
                }

                calcTotal();
            });
        }
    });

    function submitForm(url,redirect)
    { 
        showLoader();
        event.preventDefault();
       
        const data = new FormData(); 
        const appoValue = document.querySelector('#appointments').dataset.object ? JSON.parse(document.querySelector('#appointments').dataset.object).id : "";
        const clientValue = document.querySelector('#clients').dataset.object ? JSON.parse(document.querySelector('#clients').dataset.object).id : "";
        
        data.append("appointment", appoValue);
        data.append("clients", clientValue);
        data.append("notes", document.querySelector('#notes').value);
        data.append("status", event.submitter.name == "save" ? 1 : 2);

        document.querySelectorAll('.item-row').forEach((item) => {
            let inputs = item.querySelectorAll('input');

            data.append(inputs[0].name,JSON.parse(inputs[0].dataset.object).name);

            if(JSON.parse(inputs[0].dataset.object).name == "Servicios"){
                let item = inputs[1].dataset.object ? JSON.parse(inputs[1].dataset.object)?.id : "";
                data.append("items[]",item);
            }else if(JSON.parse(inputs[0].dataset.object).name == "Productos"){
                let item = inputs[2].dataset.object ? JSON.parse(inputs[2].dataset.object)?.id : "";
                data.append("items[]",item);
            }else{
                data.append("items[]","");
            }


            data.append(inputs[3].name, inputs[3].value); 
            data.append(inputs[4].name, inputs[4].value); 

            let user = inputs[5].dataset.object? JSON.parse(inputs[5].dataset.object).id : "";
            data.append(inputs[5].name,user);
        });

        let allRows = document.querySelectorAll("#detailContent .item-row");
        let total   = 0;

        allRows.forEach(element => {
            const inputsArr = element.querySelectorAll("input");
 
            total+= inputsArr[3].value * inputsArr[4].value;
        });

        data.append("subtotal",total.toFixed(2));
        
        fetch(url, { 
            headers: { 
                "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json', 
            },   
            credentials: 'include',
            method: "post", 
            body: data,
        })
        .then((res) => { 
            if (!res.ok) { 
                //location.href = "{{$menu['baseURL'].$menu['route']['dashboard']['root']}}";
            }

            return res.json();
        })
        .then((json) => {
            
            hideLoader();

            if(json.status){
                location.href = redirect;
            }
            else{
                document.querySelector("#errorMessage").innerHTML = json.message;
                
                setTimeout(() => {
                    document.querySelector("#errorMessage").innerHTML = "";
                }, "10000");
            }
        })
        .catch((err) => console.error("error:", err));
    }

    if(selling.id){
        const client = clients.filter(client => client.id == selling.client);  
        const appointment = appointments.filter(appointment => appointment.id == selling.appointment);

        if(client.length != 0){
            let eClient = document.querySelector("#clients");
            eClient.dataset.object = JSON.stringify(client[0]); 
            eClient.value = client[0].name;
        }

        if(appointment.length != 0){
            let eAppointment = document.querySelector("#appointments");
            eAppointment.dataset.object = JSON.stringify(appointment[0]); 
            eAppointment.value = appointment[0].name;
        }

        let detail = JSON.parse(selling.detail);
         
        detail.types.forEach((element,index) => {
            let type = element;
            let item = detail.items[index];
            let qty  = detail.qty[index];
            let price = detail.price[index];
            let user = detail.users[index];

            handleAddItem(()=> {  
                var typeNode = getLastElement(".types");
                var priceNode   = getLastElement(".prices");
                var userNode   = getLastElement(".users");
                var qtyNode   = getLastElement(".qty");
                var serviceNode   = getLastElement(".services");
                var productNode   = getLastElement(".products");

                typeNode.value = type; 
                typeNode.dataset.object = JSON.stringify(types.filter(t => t.name == type)[0]);

                if(type == types[1].name){
                    serviceNode.parentNode.style.display = "inherit";
                    productNode.parentNode.style.display = "none"; 

                    var service = services.filter(service => service.id == item)[0];

                    serviceNode.value = service.name;
                    serviceNode.dataset.object = JSON.stringify(service);
                }else{
                    productNode.parentNode.style.display = "inherit";
                    serviceNode.parentNode.style.display = "none"; 

                    let product = products.filter(product => product.id == item)[0];

                    productNode.value = product.name;
                    productNode.dataset.object = JSON.stringify(product);
                }

                var userItem = users.filter(u => u.id == user)[0];

                userNode.value = userItem.name;
                userNode.dataset.object = JSON.stringify(userItem);

                priceNode.value = price;
                qtyNode.value   = qty;
                 
                calcTotal();
            });
        });
    }
  </script>
@stop


