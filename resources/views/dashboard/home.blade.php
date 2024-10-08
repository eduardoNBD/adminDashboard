@extends('layouts.dashboard',[ 'current_route'  => '/dashboard'])

@section('title', 'Home - Dashboard') 

@section('content')
    <div class="grid gap-3 grid-cols-1 md:grid-cols-12"> 
        <section class="sm:col-span-12 md:col-span-8">
            @include('../components/welcome')
        </section>
        <section class="sm:col-span-12 md:col-span-4">
            @include('../components/recentsAppointment', ['title' => 'Proximas citas', 'data' => $appointments])
        </section>
        <section class="sm:col-span-12 md:col-span-4">
            @include('../components/textContent', [
                'color' => 'bg-gradient-to-r from-violet-700 to-violet-500',
                'title' => 'Numero de citas para hoy',
                'subtitle' => $appoToday.' Citas',
                'icon' =>
                    '<svg class="ml-auto text-white" xmlns="http://www.w3.org/2000/svg"  width="50"  height="50"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.4"  stroke-linecap="round"  stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.5 21h-4.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v3" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h10" /><path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M18 16.5v1.5l.5 .5" /></svg>',
            ])
        </section>
        <section class="sm:col-span-12 md:col-span-4">
            @include('../components/textContent', [
                'color' => 'bg-gradient-to-r from-purple-700 to-purple-500',
                'title' => 'Numero de citas pendientes hoy',
                'subtitle' => $appoPendi.' Citas',
                'icon' =>
                    '<svg class="ml-auto text-white" xmlns="http://www.w3.org/2000/svg"  width="50"  height="50"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.4"  stroke-linecap="round"  stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.5 21h-4.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v3" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h10" /><path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M18 16.5v1.5l.5 .5" /></svg>',
            ])
        </section>
        <section class="sm:col-span-12 md:col-span-4">
            @include('../components/textContent', [
                'color' => 'bg-gradient-to-r from-purple-700 to-purple-500',
                'title' => 'Numero de citas Atendidas hoy',
                'subtitle' => $appoFinis.' Citas',
                'icon' =>
                    '<svg class="ml-auto text-white" xmlns="http://www.w3.org/2000/svg"  width="50"  height="50"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.4"  stroke-linecap="round"  stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.5 21h-4.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v3" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h10" /><path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M18 16.5v1.5l.5 .5" /></svg>',
            ])
        </section> 
        @if(Auth::user()->role == 1)
            <section class="sm:col-span-12 md:col-span-4">
                @include('../components/topProducts', ['title' => 'Top 5 productos mas vendidos', 'data' =>  $topProducts])
            </section>
            <section class="sm:col-span-12 md:col-span-4">
                @include('../components/pendingPayments', ['title' => 'Top 5 ventas de empleados de la semana', 'data' =>  $profitsWeeks])
            </section>
            <div class="sm:col-span-12 md:col-span-4">
                <section class="bg-white relative shadow-md rounded-lg p-4 h-full">
                    <div class="flex">
                        <h1 class="font-bold text-gray-700">Ventas de los ultimos 4 meses</h1>
                        <a href={{$menu['baseURL'].$menu['route']['appointments']['root']}} class="text-sm font-bold block ml-auto">Ver Más</a>
                    </div>
                    <hr class="mt-2 mb-4"/>
                    <div class="flex items-center"> 
                        <canvas id="myChart"></canvas>
                    </div>
                </section>
            </div>
        @endif
    </div>  
@stop

@section('scripts')
    <script src="{{ asset('../resources/js/libs/chart/chart.js') }}"></script>
    <script>
        const ctx = document.getElementById('myChart');

        if(ctx){
            const chartValues  = {!! json_encode($chartValues)!!}; 
            const cfg = {
                type: 'bar',
                data: {
                        labels: chartValues.map(element => monthsNamesEsp[element.month-1]),
                        datasets: [{ 
                            data: chartValues.map(element => element.total), 
                            backgroundColor:["#4f46e5"],
                            hoverBackgroundColor:["#6d28d9"]
                        }
                    ]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false, 
                        },
                        tooltip: {
                            callbacks: {
                                title: function (tooltipItem, data) { 
                                    return tooltipItem[0].label;
                                },
                                label: function (tooltipItem, data) { 
                                    return 'Total: $' + tooltipItem.formattedValue;
                                }
                            }
                        }
                    },
                }
            };
        
            const chart = new Chart(ctx.getContext("2d"), cfg);
        }
    </script>
@stop
