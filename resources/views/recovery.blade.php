@extends('layouts.noAuth')
 
@section('title', 'Recuperar contraseña')
 
@section('content')
    <main class="flex h-screen flex-col justify-between bg-[#dddddd]">
        <section class="mx-auto my-10 md:my-auto max-[480px]:w-full md:w-[400px] border-l-2 border-t-2 border-t-violet-500 border-l-violet-500 rounded-tl-lg">
            <div class="rounded-lg m-5 p-5 pt-10 pb-5 bg-[#ffffff] h-full md:w-[400px] shadow-lg">
                <span class="block rounded-full m-auto bg-gradient-to-tr from-violet-500 to-pink-400 w-[70px] h-[70px]" ></span>
                <h1 class="text-center text-3xl mb-4 text-[#444444] font-bold">Recuperar contraseña</h1>
                <hr />
                <form action="{{$menu['baseURL'].$menu['route']['dashboard']['root']}}" onsubmit="recover()" class="mt-6 p-2">
                    <label htmlFor="" class="w-full block">
                        <strong class="text-[#444444]">E-mail</strong> 
                        <input type="text" name="email" placeholder="Ingresa tu E-mail" class="w-full rounded-md p-2 mt-2 focus:outline-violet-500 border"/>
                    </label> 
                    <button class="bg-violet-600 w-full mt-8 rounded-md p-2 text-[#ebf3ffe6]" type="submit">
                        Enviar token
                    </button>
                </form>
                <label id="successMessage" class="text-emerald-600 text-center block"></label>  
                <label id="errorMessage" class="text-red-600 text-center block"></label> 
            </div>
        </section> 
    </main>
@stop

@section('scripts')
    <script src="{{ asset('../resources/js/loader.js') }}"></script> 
    <script>
        function recover(){
            showLoader();
            event.preventDefault();

            const data = new FormData(event.target);  
            console.log(data);
            fetch("{{$menu['baseURL']."/auth/recover"}}", {  
                method: "post", 
                body: data,
            })
            .then((res) => res.json())
            .then((json) => {
                hideLoader();
                
                if(json.status){
                    document.querySelector("#successMessage").innerHTML = json.message;
                }
                else{
                    document.querySelector("#errorMessage").innerHTML = json.message;
                    
                    setTimeout(() => {
                        document.querySelector("#errorMessage").innerHTML = "";
                    }, "5000");
                }
            })
            .catch((err) => {hideLoader(); console.error("error:", err)}); 
        }
    </script>
@stop