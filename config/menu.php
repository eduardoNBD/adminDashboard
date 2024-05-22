<?php
$routes = [
    "dashboard" => [
        "root" => "/dashboard", 
    ],
    "appointments" => [
        "root" => "/dashboard/appointments",
        "new" => "/dashboard/appointments/appointment",
        "calendar" => "/dashboard/appointments/calendar",
        "edit" => function($id) { return "/dashboard/appointments/appointment/" . $id; },
        "detail" => function($id) { return "/dashboard/appointments/detail/" . $id; }
    ],
    "sellings" => [
        "root" => "/dashboard/sellings",
        "new" => "/dashboard/sellings/selling",
        "calendar" => "/dashboard/sellings/calendar",
        "edit" => function($id) { return "/dashboard/sellings/selling/" . $id; },
        "detail" => function($id) { return "/dashboard/sellings/detail/" . $id; }
    ],
    "users" => [
        "root" => "/dashboard/users",
        "new" => "/dashboard/users/user",
        "edit" => function($id) { return "/dashboard/users/user/" . $id; },
        "detail" => function($id) { return "/dashboard/users/detail/" . $id; }
    ],
    "clients" => [
        "root" => "/dashboard/clients",
        "new" => "/dashboard/clients/client",
        "edit" => function($id) { return "/dashboard/clients/client/" . $id; }
    ],
    "products" => [
        "root" => "/dashboard/products",
        "new" => "/dashboard/products/product",
        "edit" => function($id) { return "/dashboard/products/product/" . $id; }
    ],
    "services" => [
        "root" => "/dashboard/services",
        "new" => "/dashboard/services/service",
        "edit" => function($id) { return "/dashboard/services/service/" . $id; }
    ],
    "profile" => "/dashboard/profile"
];

$menu = [
    "group" => [
        "dashboard" => [
            "route" => "/dashboard",
            "title" => "Dashboard",
            "icon" => '<svg class="flex-shrink-0 mr-2 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>',
            "button" => null
        ],
        "appointments" => [
            "route" => "/dashboard/appointments",
            "title" => "Citas",
            "icon" => '<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0 mr-2 w-6 h-6"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.5 21h-4.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v3" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h10" /><path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M18 16.5v1.5l.5 .5" /></svg>',
            "button" => [
                "icon" => '<svg class="h-3.5 w-3.5" fill="#ffffff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path clipRule="evenodd" fillRule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"></path></svg>',
                "url" => $routes['appointments']['new']
            ]
        ],
        "clients" => [
            "route" => "/dashboard/clients",
            "title" => "Clientes",
            "icon" => '<svg class="flex-shrink-0 mr-2 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>',
            "button" => [
                "icon" => '<svg class="h-3.5 w-3.5" fill="#ffffff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path clipRule="evenodd" fillRule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"></path></svg>',
                "url" =>  $routes['clients']['new']
            ]
        ],
        "products" => [
            "route" => "/dashboard/products",
            "title" => "Productos",
            "icon" => '<svg class="flex-shrink-0 mr-2 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" /></svg>',
            "button" => [
                "icon" => '<svg class="h-3.5 w-3.5" fill="#ffffff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path clipRule="evenodd" fillRule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"></path></svg>',
                "url" => $routes['products']['new']
            ]
        ],
        "services" => [
            "route" => "/dashboard/services",
            "title" => "Servicios",
            "icon" => '<svg class="flex-shrink-0 mr-2 w-6 h-6"  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M9.15 14.85l8.85 -10.85" /><path d="M6 4l8.85 10.85" /></svg>',
            "button" => [
                "icon" => '<svg class="h-3.5 w-3.5" fill="#ffffff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path clipRule="evenodd" fillRule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"></path></svg>',
                "url" => $routes['services']['new']
            ]
        ],
        "sellings" => [
            "route" => "/dashboard/sellings",
            "title" => "Ventas",
            "icon" => '<svg class="flex-shrink-0 mr-2 w-6 h-6" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 9m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" /><path d="M14 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2" /></svg>',
            "button" => [
                "icon" => '<svg class="h-3.5 w-3.5" fill="#ffffff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path clipRule="evenodd" fillRule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"></path></svg>',
                "url" => $routes['sellings']['new']
            ]
        ],
        "users" => [
            "route" => "/dashboard/users",
            "title" => "Usuarios",
            "icon" => '<svg class="flex-shrink-0 mr-2 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>',
            "button" => [
                "icon" => '<svg class="h-3.5 w-3.5" fill="#ffffff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path clipRule="evenodd" fillRule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"></path></svg>',
                "url" => $routes['users']['new']
            ]
        ]
    ]
];

$menuWorker = [
    "group" => [
        "dashboard" => [
            "route" => "/dashboard",
            "title" => "Dashboard",
            "icon" => '<svg class="flex-shrink-0 mr-2 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>',
            "button" => null
        ],
        "appointments" => [
            "route" => "/dashboard/appointments",
            "title" => "Citas",
            "icon" => '<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0 mr-2 w-6 h-6"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.5 21h-4.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v3" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h10" /><path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M18 16.5v1.5l.5 .5" /></svg>',
            "button" => [
                "icon" => '<svg class="h-3.5 w-3.5" fill="#ffffff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path clipRule="evenodd" fillRule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"></path></svg>',
                "url" => $routes['appointments']['new']
            ]
        ],
        "clients" => [
            "route" => "/dashboard/clients",
            "title" => "Clientes",
            "icon" => '<svg class="flex-shrink-0 mr-2 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>',
            "button" => [
                "icon" => '<svg class="h-3.5 w-3.5" fill="#ffffff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path clipRule="evenodd" fillRule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"></path></svg>',
                "url" =>  $routes['clients']['new']
            ]
        ], 
    ]
];

