@extends('layouts.dashboard',[ 'current_route'  => '/dashboard/sellings'])

@section('title', $title.' - Dashboard') 
 
@section('content') 

<div class="rounded-lg overflow-hidden" id="pdf-preview" class="h-0">
    
</div>
<section class="bg-white px-0 md:px-5 pt-5 pb-5 w-full lg:w-5/6 rounded-lg m-auto mt-5">
    <div class="px-5">
        <button onclick="generatePDF('preview')" class="text-gray-500 border-gray-500 hover:text-white hover:bg-gray-500 border-2 ml-4 float-right p-1 rounded-lg" title="Crear PDF">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path></svg>
        </button>
        <button onclick="generatePDF('download')" class="float-right text-emerald-500 border-2 border-emerald-500 hover:bg-emerald-500 hover:text-white p-1 rounded-lg" title="Crear PDF">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-printer"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
        </button>
    </div>
    <h1 class="text-center text-2xl font-bold text-[#526270] pb-4">{{$title}}</h1>
    <hr />
    <div class="grid grid-cols-1 gap-4 md:gap-8 md:grid-cols-2 m-2 md:m-10 md:mt-6"> 
        <div class="col-span-2 md:col-span-1">
            <div class="autocomplete relative group">
                <input disabled type="text" autocomplete="off" name="appointments" id="appointments" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-[1px] border-[#526270] appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="appointments" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Cita</label>
            </div>
        </div>  
        <div class="col-span-2 md:col-span-1">
            <div class="autocomplete relative group">
                <input disabled type="text" autocomplete="off" name="clients" id="clients" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-[1px] border-[#526270] appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="clients" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Cliente</label>
            </div>
        </div>  
        <div class="col-span-2 md:col-span-1  mt-[18px]">
            <div class="relative z-0 group">
                <input disabled type="text" value="{{$selling->notes}}" autocomplete="off" name="notes" id="notes" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-[1px] border-[#526270] appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="notes" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Notas de venta</label>
            </div>
        </div> 
        <h1 class="col-span-2 text-2xl font-bold text-[#526270]">Detalle</h1> 
        <div class="col-span-2 border-[1px] border-gray-200 rounded-lg p-2 ">                            
            <div id="detailContent">
            </div>  
            <div class="grid grid-cols-5 mt-10"> 
                <div class="col-span-4 ml-auto">Total:</div>
                <div id="total" class="border-t-2 text-right pr-4">$ {{number_format((float)$selling->subtotal, 2, '.', '');}}</div>
            </div> 
        </div>  
    </div> 
</section>  
@stop

@section('scripts')
<script src="{{ asset('../resources/js/libs/jsPDF/jspdf.umd.min.js') }}"></script>  
<script src="{{ asset('../resources/js/libs/pdf/pdf.min.js') }}"></script>   
<script src="{{ asset('../resources/fonts/firaSans.js') }}"></script> 
<script> 
 

    const appointments  = {!! json_encode($appointments)!!};
    const clients  = {!! json_encode($clients)!!};
    const services = {!! json_encode($services)!!};
    const products = {!! json_encode($products)!!};
    const users    = {!! json_encode($users)!!}; 
    const types    = [{name:"Productos"},{name:"Servicios"}];
    const selling  = {!! json_encode($selling) !!};
    const newRow = '<div class="overflow-x-auto overflow-y-none item-row">'+
                        '<div class="grid grid-cols-3 gap-4 min-w-[700px] my-6">'+  
                            '<div class="flex gap-1 col-span-2">'+
                                '<div class="w-14">'+
                                    '<div class="relative z-0 mt-1 group">'+
                                        '<input disabled min="1" value="1" type="number" name="qty[]" class="qty block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-[1px] border-[#526270] appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />'+
                                        '<label class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Cantidad</label>'+
                                    '</div>'+
                                '</div>'+ 
                                '<div class="relative z-0 mt-1 group flex-1">'+
                                    '<input disabled type="text" name="services[]" autocomplete="off" class="services block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-[1px] border-[#526270] appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />'+
                                    '<label for="services" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Servicio</label>'+
                                '</div>'+
                                '<div class="relative z-0 mt-1 group flex-1" style="display:none">'+
                                    '<input disabled type="text" name="products[]" autocomplete="off" class="products block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-[1px] border-[#526270] appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />'+
                                    '<label for="products" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Producto</label>'+
                                '</div>'+ 
                            '</div>'+
                            '<div class="flex gap-1">'+
                                '<div class="relative z-0 mt-1 group">'+
                                    '<input disabled readOnly  value="0" type="text"  name="price[]" class="prices block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-[1px] border-[#526270] appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />'+
                                    '<label class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Precio</label>'+
                                '</div>'+
                                '<div class="relative z-0 mt-1 group">'+
                                    '<input disabled onchange="changeQty()" value="1" type="text" name="subtotal[]" class="text-right subtotal block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-[1px] border-[#526270] appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />'+
                                    '<label class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Sub total</label>'+
                                '</div>'+
                            '</div>'+ 
                        '</div>'+
                        '<hr/>'+
                    '</div>';

    async function handleAddItem(callback){
        var temp       = document.createElement('div');
        temp.innerHTML = (newRow);

        document.querySelector("#detailContent").appendChild(temp.childNodes[0]);

        if(callback) await callback();
    }

    
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
            var priceNode   = getLastElement(".prices");
            var userNode   = getLastElement(".users");
            var qtyNode   = getLastElement(".qty");
            var serviceNode   = getLastElement(".services");
            var productNode   = getLastElement(".products");
            var subtotalNode   = getLastElement(".subtotal");

            if(type == types[1].name){
                serviceNode.parentNode.style.display = "inherit";
                productNode.parentNode.remove();

                var service = services.filter(service => service.id == item)[0];

                serviceNode.value = service.name; 
            }else{
                productNode.parentNode.style.display = "inherit";
                serviceNode.parentNode.style.display = "none"; 

                let product = products.filter(product => product.id == item)[0];

                productNode.value = product.name; 
            }

            priceNode.value = price;
            qtyNode.value   = qty;
            subtotalNode.value = "$ "+(price * qty);
        });
    }); 

    function generatePDF(action){  
        const { jsPDF } = window.jspdf;
        const doc       = new jsPDF();
        const client = clients.filter(client => client.id == selling.client);  
        var text = "Cliente: " + (client.name ? client.name : "Sin cliente");
        var textWidth = doc.getStringUnitWidth(text) * 14 / doc.internal.scaleFactor;
        var x = doc.internal.pageSize.width - textWidth - 10; 

        doc.setProperties({
            title: 'Recibo de venta '+selling.no,
            subject: 'Detalles de la venta',
            author: 'Admin Dashboard',
            keywords: 'recibo, venta, pdf',
            creator: 'NBD'
        });

        doc.setTextColor(80,80,80);
        doc.setFontSize(14); 
        doc.setFont(undefined,"bold");
        doc.text('Recibo de venta: ', 10, 30); 
        doc.setFont(undefined,"normal");
        doc.text("#"+selling.no.toString(), 52, 30);
        doc.setFont(undefined,"bold");
        doc.text("Cliente:", x, 30);
        doc.setFont(undefined,"normal");
        doc.text((client.name ? client.name : "Sin cliente"), x+20, 30);
        doc.setFont(undefined,"bold");
        doc.text('Notas de venta: ', 10, 38); 
        doc.setFont(undefined,"normal");
        doc.text(selling.notes, 48, 38);
        doc.setFont(undefined,"bold");
        doc.setFontSize(20); 
        doc.text('Detalle', 10, 52);
        doc.setFontSize(14); 
        doc.setDrawColor(145, 135, 178);  
        doc.setFillColor(145, 135, 178); 
        doc.setTextColor(255,255,255);
        doc.rect(5, 57, 200, 13, 'FD');
        doc.text('Cantidad ', 10, 65);
        doc.text('Servicio o producto', 40, 65);
        doc.text('Precio', 140, 65);
        doc.text('Sub total', 175, 65);
        doc.setFont(undefined,"normal");
        doc.setFontSize(12); 
        let currentHeight = 79;

        detail.types.forEach((element,index) => { 
            let type = element;
            let item = detail.items[index];
            let qty  = detail.qty[index];
            let price = detail.price[index]; 

            if((index+1)%2 == 0){ 
                doc.setDrawColor(235, 235, 235);  
                doc.setFillColor(235, 235, 235); 
                doc.setTextColor(100,100,100);
                doc.rect(5, (currentHeight-8), 200, 12, 'FD');
            }else{
                doc.setDrawColor(250, 250, 250);  
                doc.setFillColor(250, 250, 250); 
                doc.setTextColor(80,80,80);
                doc.rect(5, (currentHeight-8), 200, 12, 'FD');
            }

            doc.text(qty, 10, currentHeight);
            
            const startXPosition = 140;
            const endXPosition = 160; 
 
            const priceTextWidth = doc.getStringUnitWidth(("$ "+parseFloat(price).toFixed(2))) * doc.internal.getFontSize() / doc.internal.scaleFactor;

            const priceXPosition = endXPosition - priceTextWidth;
            doc.text("$ "+parseFloat(price).toFixed(2), priceXPosition, currentHeight);

            var textWidth = doc.getStringUnitWidth("$ "+parseFloat(qty*price).toFixed(2)) * doc.internal.getFontSize() / doc.internal.scaleFactor;
            var xPosition = 200 - textWidth - 5;
            doc.text("$ "+parseFloat(qty*price).toFixed(2), xPosition, currentHeight);

            if(type == types[1].name){ 
                var service = services.filter(service => service.id == item)[0];
                doc.text(service.name, 40, currentHeight);
            }else{ 
                let product = products.filter(product => product.id == item)[0];
                doc.text(product.name, 40, currentHeight);
            }
            currentHeight+= 12;
        }); 

        doc.setTextColor(80,80,80);
        var totalText = 'Total: $ ' + selling.subtotal.toFixed(2); 
        var totalWidth = doc.getStringUnitWidth(totalText) * doc.internal.getFontSize() / doc.internal.scaleFactor;  
        var totalXPositionRight = 200 - totalWidth - 5;
        doc.setFont(undefined,"bold");
        doc.text('Total:', totalXPositionRight, currentHeight);
        doc.setFont(undefined,"normal");
        doc.text('$ ' + selling.subtotal.toFixed(2), totalXPositionRight+15, currentHeight);

        const footerText = '-'; 
        const totalPages = doc.internal.getNumberOfPages();
 
        for (let i = 1; i <= totalPages; i++) { 
            doc.setPage(i);
 
            const pageSize = doc.internal.pageSize;
            const pageHeight = pageSize.height || pageSize.getHeight();
            const textWidth = doc.getStringUnitWidth(footerText) * doc.internal.getFontSize() / doc.internal.scaleFactor;
            const textHeight = doc.internal.getLineHeight() / doc.internal.scaleFactor;
            const x = (pageSize.width - textWidth) / 2;
            const y = pageHeight - 10;  

            doc.text(footerText, x, y);
        }

        var urlImg = '{{ asset('../resources/img/logo.png') }}';
        var img = new Image(); 

        img.onload = function() {
            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0);
            var dataURL = canvas.toDataURL('image/png');
            doc.addImage(dataURL, 'PNG', 10, 8, 50, 10);

            if(action == "download"){
                doc.save('Recibo de venta '+selling.no);
            }else if(action == "preview"){
                
                const pdfBlob = doc.output('blob');
                const url = URL.createObjectURL(pdfBlob);

                const container = document.getElementById('pdf-preview'); 
                container.classList.remove("h-0");
                container.classList.add("h-[500px]");
                container.innerHTML = `<div class="bg-white h-[41px] p-2">
                                            <button onclick="closePreview()" class="border-red-700 text-white bg-red-700 border-2 ml-4 float-right p-1 rounded-lg" title="Cerrar PDF">
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="14"  height="14"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
                                            </button>
                                        </div>
                                        <iframe src="${url}" width="100%" height="450px" type="application/pdf" ></iframe>`;
            }
        }
        
        img.src = urlImg;
    }

    function closePreview(){
        const container = document.getElementById('pdf-preview'); 
        container.classList.add("h-0");
        container.classList.remove("h-[500px]");
        container.innerHTML = "";
    } 
  </script>
@stop


