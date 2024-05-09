@extends('layouts.dashboard',[ 'current_route'  => '/dashboard/sellings'])

@section('title', 'Sellings - Dashboard') 

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
                                    placeholder="Buscar" required
                                />
                            </div>
                        </form>
                    </div>
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <a href={{$menu['baseURL'].$menu['route']['sellings']['new']}}  class="flex items-center justify-center text-white bg-indigo-600 hover:bg-violet-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clipRule="evenodd" fillRule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Crear Venta
                        </a>  
                    </div>
                </div> 
                    <table class="w-full text-sm text-left text-gray-700">
                        <thead class="text-xs uppercase bg-violet-500 text-white">
                            <tr> 
                                <th scope="col" class="px-4 py-3">#</th>
                                <th scope="col" class="px-4 py-3">Cliente</th>
                                <th scope="col" class="px-4 py-3">Fecha y hora</th> 
                                <th scope="col" class="px-4 py-3 hidden md:table-cell">Total</th> 
                                <th scope="col" class="px-4 py-3 hidden md:table-cell">Status</th> 
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-200">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">213124435</a></th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">Cliente A</a></th>
                                <td class="px-4 py-3 "><span class="block text-center md:inline-block rounded-lg text-[10px] text-white bg-indigo-600 py-1 px-2 font-bold">Hoy 9:30 am</span></td>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell">$ 500.00</th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell"><span class="rounded-lg text-[10px] text-white bg-emerald-600 py-1 px-2 font-bold">Pagado</span></th>
                                <td class="px-4 py-3 flex items-center justify-end">
                                <div class="group relative">
                                    <button id="apple-imac-27-dropdown-button" data-dropdown-toggle="apple-imac-27-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-[#526270] hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="apple-imac-27-dropdown" class="absolute left-[-140px] group-hover:block hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="apple-imac-27-dropdown-button">
                                            <li>
                                                <a href={Routes.appointments.detail("12345sad")} class="block py-2 px-4 hover:bg-gray-100">Detalle</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block py-2 px-4 hover:bg-gray-100">Editar</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">213124435</a></th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">Cliente E</a></th>
                                <td class="px-4 py-3 "><span class="block text-center md:inline-block rounded-lg text-[10px] text-white bg-indigo-600 py-1 px-2 font-bold">Hoy 2:30 pm</span></td>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell">$ 500.00</th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell"><span class="rounded-lg text-[10px] text-white bg-emerald-600 py-1 px-2 font-bold">Pagado</span></th>
                                <td class="px-4 py-3 flex items-center justify-end">
                                <div class="group relative">
                                    <button id="apple-imac-27-dropdown-button" data-dropdown-toggle="apple-imac-27-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-[#526270] hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="apple-imac-27-dropdown" class="absolute left-[-140px] group-hover:block hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="apple-imac-27-dropdown-button">
                                            <li>
                                                <a href={Routes.appointments.detail("12345sad")} class="block py-2 px-4 hover:bg-gray-100">Detalle</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block py-2 px-4 hover:bg-gray-100">Editar</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">213124435</a></th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">Cliente B</a></th>
                                <td class="px-4 py-3 "><span class="block text-center md:inline-block rounded-lg text-[10px] text-white bg-indigo-600 py-1 px-2 font-bold">Hoy 5:00 pm</span></td>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell">$ 500.00</th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell"><span class="rounded-lg text-[10px] text-white bg-yellow-600 py-1 px-2 font-bold">Pendiente de pago</span></th>
                                <td class="px-4 py-3 flex items-center justify-end">
                                <div class="group relative">
                                    <button id="apple-imac-27-dropdown-button" data-dropdown-toggle="apple-imac-27-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-[#526270] hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="apple-imac-27-dropdown" class="absolute left-[-140px] group-hover:block hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="apple-imac-27-dropdown-button">
                                            <li>
                                                <a href={Routes.appointments.detail("12345sad")} class="block py-2 px-4 hover:bg-gray-100">Detalle</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block py-2 px-4 hover:bg-gray-100">Editar</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">213124435</a></th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">Cliente C</a></th>
                                <td class="px-4 py-3 "><span class="block text-center md:inline-block rounded-lg text-[10px] text-white bg-indigo-600 py-1 px-2 font-bold">Hoy 7:00 pm</span></td>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell">$ 500.00</th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell"><span class="rounded-lg text-[10px] text-white bg-yellow-600 py-1 px-2 font-bold">Pendiente de pago</span></th>
                                <td class="px-4 py-3 flex items-center justify-end">
                                <div class="group relative">
                                    <button id="apple-imac-27-dropdown-button" data-dropdown-toggle="apple-imac-27-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-[#526270] hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="apple-imac-27-dropdown" class="absolute left-[-140px] group-hover:block hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="apple-imac-27-dropdown-button">
                                            <li>
                                                <a href={Routes.appointments.detail("12345sad")} class="block py-2 px-4 hover:bg-gray-100">Detalle</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block py-2 px-4 hover:bg-gray-100">Editar</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">213124435</a></th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">Cliente D</a></th>
                                <td class="px-4 py-3"><span class="block text-center md:inline-block rounded-lg text-[10px] text-white bg-indigo-600 py-1 px-2 font-bold">Mañana 10:00 am</span></td>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell">$ 500.00</th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell"><span class="rounded-lg text-[10px] text-white bg-yellow-600 py-1 px-2 font-bold">Pendiente de pago</span></th>
                                <td class="px-4 py-3 flex items-center justify-end">
                                <div class="group relative">
                                    <button id="apple-imac-27-dropdown-button" data-dropdown-toggle="apple-imac-27-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-[#526270] hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="apple-imac-27-dropdown" class="absolute left-[-140px] group-hover:block hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="apple-imac-27-dropdown-button">
                                            <li>
                                                <a href={Routes.appointments.detail("12345sad")} class="block py-2 px-4 hover:bg-gray-100">Detalle</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block py-2 px-4 hover:bg-gray-100">Editar</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">213124435</a></th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">Cliente F</a></th>
                                <td class="px-4 py-3"><span class="block text-center md:inline-block rounded-lg text-[10px] text-white bg-indigo-600 py-1 px-2 font-bold">Mañana 12:00 pm</span></td>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell">$ 500.00</th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell"><span class="rounded-lg text-[10px] text-white bg-yellow-600 py-1 px-2 font-bold">Pendiente de pago</span></th>
                                <td class="px-4 py-3 flex items-center justify-end">
                                <div class="group relative">
                                    <button id="apple-imac-27-dropdown-button" data-dropdown-toggle="apple-imac-27-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-[#526270] hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="apple-imac-27-dropdown" class="absolute left-[-140px] group-hover:block hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="apple-imac-27-dropdown-button">
                                            <li>
                                                <a href={Routes.appointments.detail("12345sad")} class="block py-2 px-4 hover:bg-gray-100">Detalle</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block py-2 px-4 hover:bg-gray-100">Editar</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">213124435</a></th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">Cliente G</a></th>
                                <td class="px-4 py-3"><span class="block text-center md:inline-block rounded-lg text-[10px] text-white bg-indigo-600 py-1 px-2 font-bold">Mañana 5:00 pm</span></td>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell">$ 500.00</th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell"><span class="rounded-lg text-[10px] text-white bg-yellow-600 py-1 px-2 font-bold">Pendiente de pago</span></th>
                                <td class="px-4 py-3 flex items-center justify-end">
                                <div class="group relative">
                                    <button id="apple-imac-27-dropdown-button" data-dropdown-toggle="apple-imac-27-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-[#526270] hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="apple-imac-27-dropdown" class="absolute left-[-140px] group-hover:block hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="apple-imac-27-dropdown-button">
                                            <li>
                                                <a href={Routes.appointments.detail("12345sad")} class="block py-2 px-4 hover:bg-gray-100">Detalle</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block py-2 px-4 hover:bg-gray-100">Editar</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">213124435</a></th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">Cliente H</a></th>
                                <td class="px-4 py-3"><span class="block text-center md:inline-block rounded-lg text-[10px] text-white bg-indigo-600 py-1 px-2 font-bold">15 de abril 9:00 am</span></td>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell">$ 500.00</th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell"><span class="rounded-lg text-[10px] text-white bg-yellow-600 py-1 px-2 font-bold">Pendiente de pago</span></th>
                                <td class="px-4 py-3 flex items-center justify-end">
                                <div class="group relative">
                                    <button id="apple-imac-27-dropdown-button" data-dropdown-toggle="apple-imac-27-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-[#526270] hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="apple-imac-27-dropdown" class="absolute left-[-140px] group-hover:block hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="apple-imac-27-dropdown-button">
                                            <li>
                                                <a href={Routes.appointments.detail("12345sad")} class="block py-2 px-4 hover:bg-gray-100">Detalle</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block py-2 px-4 hover:bg-gray-100">Editar</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">213124435</a></th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">Cliente I</a></th>
                                <td class="px-4 py-3"><span class="block text-center md:inline-block rounded-lg text-[10px] text-white bg-indigo-600 py-1 px-2 font-bold">15 de abril 11:00 am</span></td>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell">$ 500.00</th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell"><span class="rounded-lg text-[10px] text-white bg-yellow-600 py-1 px-2 font-bold">Pendiente de pago</span></th>
                                <td class="px-4 py-3 flex items-center justify-end">
                                <div class="group relative">
                                    <button id="apple-imac-27-dropdown-button" data-dropdown-toggle="apple-imac-27-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-[#526270] hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="apple-imac-27-dropdown" class="absolute left-[-140px] group-hover:block hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="apple-imac-27-dropdown-button">
                                            <li>
                                                <a href={Routes.appointments.detail("12345sad")} class="block py-2 px-4 hover:bg-gray-100">Detalle</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block py-2 px-4 hover:bg-gray-100">Editar</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">213124435</a></th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><a href="#" class="font-bold text-[#526270]">Cliente J</a></th>
                                <td class="px-4 py-3"><span class="block text-center md:inline-block rounded-lg text-[10px] text-white bg-indigo-600 py-1 px-2 font-bold">16 de abril 9:00 am</span></td>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell">$ 500.00</th>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap hidden md:table-cell"><span class="rounded-lg text-[10px] text-white bg-yellow-600 py-1 px-2 font-bold">Pendiente de pago</span></th>
                                <td class="px-4 py-3 flex items-center justify-end">
                                <div class="group relative">
                                    <button id="apple-imac-27-dropdown-button" data-dropdown-toggle="apple-imac-27-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-[#526270] hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="apple-imac-27-dropdown" class="absolute left-[-140px] group-hover:block hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="apple-imac-27-dropdown-button">
                                            <li>
                                                <a href={Routes.appointments.detail("12345sad")} class="block py-2 px-4 hover:bg-gray-100">Detalle</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block py-2 px-4 hover:bg-gray-100">Editar</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                        </tbody>
                    </table> 
                <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                    <ul class="inline-flex ml-auto items-stretch -space-x-px">
                        <li>
                            <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-[#526270] bg-white rounded-l-lg border border-gray-300 hover:bg-violet-500 hover:text-white hover:text-gray-700 ">
                                <span class="sr-only">Previous</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fillRule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clipRule="evenodd" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#" aria-current="page" class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 bg-violet-500 text-white">1</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-[#526270] bg-white border border-gray-300 hover:bg-violet-500 hover:text-white hover:text-gray-700 ">2</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-[#526270] bg-white border border-gray-300 hover:bg-violet-500 hover:text-white hover:text-gray-700 ">3</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-[#526270] bg-white border border-gray-300 hover:bg-violet-500 hover:text-white hover:text-gray-700 ">...</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-[#526270] bg-white border border-gray-300 hover:bg-violet-500 hover:text-white hover:text-gray-700 ">100</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-[#526270] bg-white rounded-r-lg border border-gray-300 hover:bg-violet-500 hover:text-white hover:text-gray-700 ">
                                <span class="sr-only">Next</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fillRule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clipRule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
@stop

@section('scripts')
     
@stop
