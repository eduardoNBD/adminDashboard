@extends('layouts.dashboard',[ 'current_route'  => '/dashboard/appointments'])

@section('title', 'Calendario - Dashboard') 

@section('styles') 
    <style>
         .fc-event{
            cursor: pointer !important;
            font-weight: 600;
        }
        .fc-toolbar-title{
            text-transform: capitalize;
            font-weight: bold;
            color:#555;
        }
        .fc-col-header {
            text-transform: capitalize;
        }
        .fc-col-header .fc-scrollgrid-sync-inner,.fc-timegrid-axis{
            background-color: #6366f1;
            color:white;
        }
        .fc-timegrid-slot-label-frame{
            color:white;
            text-align: center !important;
            font-size: 14px !important; 
        }
        .fc-timegrid-slot-label-frame{
            margin-top: 25%;
            margin-bottom: -25%;
        }
        .fc-timeGrid-view
        { 
            overflow: hidden;
        }
        .fc-timegrid-slot-label-frame,.fc-timegrid-slot{
            height: 50px !important;
        }
        .fc-toolbar-chunk:first-child{ 
            margin-left: 50%;
            font-size: 20px;
        }
        .fc-toolbar-chunk:nth-child(3){ 
            margin-right: 10px;
        }
        .fc-header-toolbar{
            margin-bottom: 0px !important;
            background-color: #6366f1;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .fc-toolbar-chunk button{
            background-color: #4f46e5 !important;
            border-color:#3730a3 !important;
        }
        .fc-toolbar-chunk button:hover{
            background-color: #3730a3 !important; 
        }
        .fc-toolbar-title{

            color:white;
        }

        @media (max-width: 800px) {
            .fc-toolbar-chunk:first-child{ 
                margin-left: 10px; 
            }
        }
    </style>
@stop

@section('content') 
<section class="bg-white px-0 md:px-5 pt-5 pb-5 w-full lg:w-5/6 rounded-lg m-auto mt-5">
    <div class="shadow-lg"id='calendar'></div>
</section>
<div id="popup-detail" tabindex="-1" class="hidden flex -mt-16 md:mt-0 bg-[#0000006b] overflow-hidden fixed top-14 right-0 left-0 z-50 justify-center  w-full md:inset-0 h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow overflow-hidden p-2 px-4">
            <button onclick="closeModal('#popup-detail')" type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button> 
            <h2 class="text-md text-[#526270] py-4 bold">Detalle de cita</h2> 
            <hr>
            <div id="contentDetail">
                
            </div> 
        </div>
    </div>
</div>
@stop

@section('scripts')
<script src="{{ asset('../resources/js/libs/fullcalendar/index.global.min.js') }}"></script>  
<script src="{{ asset('../resources/js/libs/fullcalendar/core/locales-all.global.min.js')}}"></script>
<script>
    const status = {!! json_encode($status)!!};
    const colors = {!! json_encode($colors)!!};
    var calendarEl = document.getElementById('calendar');
    var numRows;

    function setNumRows() {
        if (window.innerWidth > 1000) {
            numRows = 6;
        } else if (window.innerWidth < 1000 && window.innerWidth > 800) {
            numRows = 4;
        } else {
            numRows = 2;
        }
    }

    setNumRows(); // Establecer numRows inicial

    var calendar = new FullCalendar.Calendar(calendarEl, {
        weekends: true,
        selectable: true,
        events: function(info, successCallback, failureCallback) { 
            var start = info.startStr;
            var end = info.endStr;

            fetch('{{$menu['baseURL']."/appointments/listByDates/"}}?start=' + start + '&end=' + end)
            .then(function(response) {
                return response.json();
            })
            .then(function(data) { 
                successCallback(data.appointments);
            })
            .catch(function(error) { 
                failureCallback(error);
            });
        },
        height: "auto", 
        locale: 'es',
        titleFormat: { year: undefined, month: 'long', day: undefined },
        slotLabelFormat: { hour: 'numeric', minute: '2-digit' },
        dayHeaderFormat: { weekday: 'short', month: undefined, day: '2-digit' },
        titleRangeSeparator: '/',
        timeZone: Intl.DateTimeFormat().resolvedOptions().timeZone,
        allDaySlot: false,
        slotMinTime: "09:00:00",
        slotMaxTime: "20:00:00",
        initialView: 'timeGrid',
        eventClick: (info) => {
            if (info.event) {
                showDetail(info.event._def);
            } else {
                console.log("Evento no definido");
            }
        },
        dayCount: numRows
    });

    window.addEventListener('resize', () => {
        setNumRows();
        calendar.setOption('dayCount', numRows);  
        calendar.render();  
    });

    calendar.render();
    
    function closeModal(id){ 
        document.querySelector(id).classList.add("hidden");
    }

    function showDetail(data){ 
        let rowHTML =   '<div>'+
                            '<section class="my-2 clear-both px-3">'+
                                '<span class="float-right rounded-lg text-[10px] text-white '+colors[data.extendedProps.status]+' py-1 px-2 font-bold">'+status[data.extendedProps.status]+'</span>'+
                                '<span class="rounded-lg text-sm text-gray-400">'+reformatDate(data.extendedProps.start)+'</span>'+ 
                                '<h2 class="text-xl text-[#526270] bold text-center clear-both">'+data.extendedProps.title+'</h2> '+
                            '</section> '+
                            '<hr> '+ 
                            '<section class="my-2">'+
                                '<div class="px-2 my-2 mt-[18px]">'+
                                    '<div class="relative z-0 mb-5 group">'+
                                        '<input type="text" readonly name="name" value="'+(data.extendedProps.client_id != null ? data.extendedProps.client_id : "Sin Cliente")+'" id="name" class="block py-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " />'+
                                        '<label for="name" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Cliente</label>'+
                                    '</div>'+
                                '</div>'+
                            '</section> '+  
                            '<section class="my-2">'+
                                '<div class="px-2 my-2 mt-[18px]">'+
                                    '<div class="relative z-0 mb-5 group">'+
                                        '<input type="text" readonly name="name" value="'+(data.extendedProps.service_id != null ? data.extendedProps.service_id : "Sin servicio definido")+'" id="name" class="block py-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " />'+
                                        '<label for="name" class="peer-focus:font-medium absolute text-sm text-[#526270] dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Servicio</label>'+
                                    '</div>'+
                                '</div>'+ 
                            '</section> '+ 
                            '<h2 class="text-xl text-[#526270] bold text-center">Notas:</h2>'+
                            '<p>'+data.extendedProps.notes+'</p>'+ 
                        '</div>'; 
        
        document.querySelector("#contentDetail").innerHTML = rowHTML; 
        document.querySelector("#popup-detail").classList.remove("hidden"); 
    }   
</script>
@stop
