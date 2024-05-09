<html>
    <head>
        <title>App Name - @yield('title')</title>
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width,initial-scale=1.0"> 
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel=”stylesheet”>
        <link rel="stylesheet" href="{{ asset('../resources/css/build.css') }}"> 
    </head>
    <body>  
        @yield('content')
    </body>
    @yield('scripts') 
</html>