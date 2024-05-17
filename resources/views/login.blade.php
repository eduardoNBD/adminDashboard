@extends('layouts.noAuth')
 
@section('title', 'Login')
 
@section('content')
    <main class="flex h-screen flex-col justify-between bg-[#dddddd]">
        <section class="mx-auto my-10 md:my-auto max-[480px]:w-full md:w-[400px] border-l-2 border-t-2 border-t-violet-500 border-l-violet-500 rounded-tl-lg">
            <div class="rounded-lg m-5 p-5 pt-10 pb-5 bg-[#ffffff] h-full md:w-[400px] shadow-lg">
                <span class="block rounded-full m-auto bg-gradient-to-tr from-violet-500 to-pink-400 w-[70px] h-[70px]" ></span>
                <h1 class="text-center text-3xl mb-4 text-[#444444] font-bold">Bienvenido</h1>
                <hr />
                <form action="{{$menu['baseURL'].$menu['route']['dashboard']['root']}}" onsubmit="Login()" class="mt-6 p-2">
                    <label htmlFor="" class="w-full block">
                        <strong class="text-[#444444]">Usuario</strong> 
                        <input type="text" name="username" placeholder="Ingresa tu usuario" class="w-full rounded-md p-2 mt-2 focus:outline-violet-500 border"/>
                    </label>
                    <label htmlFor="" class="w-full block mt-4">
                        <strong class="text-[#444444]">Contraseña</strong> 
                        <input type="password"  name="password" placeholder="Ingresa tu contraseña" class="w-full rounded-md p-2 mt-2 focus:outline-violet-500 border"/>
                    </label>
                    <button class="bg-violet-600 w-full mt-8 rounded-md p-2 text-[#ebf3ffe6]" type="submit">
                        Iniciar Sesión
                    </button>
                </form>
                <label id="errorMessage" class="text-red-600 text-center block"></label>
                <a href="" class="float-end mt-2 font-[500] text-[#666666]">¿Olvidaste tu contraseña?</a>
            </div>
        </section> 
    </main>
@stop
@section('scripts')
     <script>
        function Login(){
            event.preventDefault();

            const data = new FormData(event.target); 
            
            data.append("timezone",Intl.DateTimeFormat().resolvedOptions().timeZone);
            
            fetch("{{$menu['baseURL']."/auth/login"}}", {  
                method: "post", 
                body: data,
            })
            .then((res) => res.json())
            .then((json) => {
                if(json.status){
                    location.href = "{{$menu['baseURL'].$menu['route']['dashboard']['root']}}";
                }
                else{
                    document.querySelector("#errorMessage").innerHTML = json.message;
                    
                    setTimeout(() => {
                        document.querySelector("#errorMessage").innerHTML = "";
                    }, "5000");
                }
            })
            .catch((err) => console.error("error:", err)); 
        }
     </script>
@stop