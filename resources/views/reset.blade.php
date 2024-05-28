@extends('layouts.noAuth')
 
@section('title', 'Recuperar contraseña')
 
@section('content')
    <main class="flex h-screen flex-col justify-between bg-[#dddddd]">
        <section class="mx-auto my-10 md:my-auto max-[480px]:w-full md:w-[400px] border-l-2 border-t-2 border-t-violet-500 border-l-violet-500 rounded-tl-lg">
            <div class="rounded-lg m-5 p-5 pt-10 pb-5 bg-[#ffffff] h-full md:w-[400px] shadow-lg">
                <span class="block rounded-full m-auto bg-gradient-to-tr from-violet-500 to-pink-400 w-[70px] h-[70px]" ></span>
                <h1 class="text-center text-3xl mb-4 text-[#444444] font-bold">Recuperar contraseña</h1>
                <hr />
                <form onsubmit="resetPassword()" class="mt-6 p-2">
                    <input type="hidden" name="token" value="{{$token ? $token->token : ""}}">
                    <div class=" mt-[18px]">
                        <div class="relative z-0 group">
                            <input type="text" name="email" id="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " />
                            <label for="email" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">E-mail</label>
                        </div>
                    </div> 
                    <div class=" mt-[18px]">
                        <div class="col-span-2 md:col-span-1 flex">
                            <div class="relative z-0 group w-full">
                                <input type="password" name="password" id="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " />
                                <label for="password" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nueva contraseña</label>
                            </div>
                            <button type="button" onclick="seePasswordInput(document.querySelector('#password'))" class="-ml-5 h-full text-sm font-medium focus:outline-none z-20">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#526270"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                            </button>
                            <button type="button" onclick="hidePasswordInput(document.querySelector('#password'))" class="hidden -ml-5 h-full text-sm font-medium focus:outline-none z-20">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#526270"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" /><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" /><path d="M3 3l18 18" /></svg>
                            </button>
                        </div> 
                    </div>
                    <div class=" mt-[18px]">
                        <div class="col-span-2 md:col-span-1 flex">
                            <div class="relative z-0 group w-full">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-purple-600 peer" placeholder=" " />
                                <label for="password_confirmation" class="peer-focus:font-medium absolute text-sm text-[#526270] duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-purple-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirmar nueva contraseña</label>
                            </div>
                            <button type="button" onclick="seePasswordInput(document.querySelector('#password_confirmation'))" class="-ml-5 h-full text-sm font-medium focus:outline-none z-20">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#526270"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                            </button>
                            <button type="button" onclick="hidePasswordInput(document.querySelector('#password_confirmation'))" class="hidden -ml-5 h-full text-sm font-medium focus:outline-none z-20">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#526270"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" /><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" /><path d="M3 3l18 18" /></svg>
                            </button>
                        </div> 
                    </div> 
                    <button class="bg-violet-600 w-full mt-8 rounded-md p-2 text-[#ebf3ffe6]" type="submit" {{!$token ? "disabled" : ""}}>Cambiar contraseña</button>
                </form>
                @if(!$token)
                    <label id="errorMessage" class="text-red-600 text-center block">Token erroneo o ya se uso</label> 
                @endif
                <label id="successMessage" class="text-emerald-600 text-center block"></label> 
                <label id="errorMessage" class="text-red-600 text-center block"></label> 
            </div>
        </section> 
    </main> 
@stop

@section('scripts')
    <script src="{{ asset('../resources/js/inputsPassword.js') }}"></script> 
    <script>
        function resetPassword(){
            showLoader();
            event.preventDefault();

            const data = new FormData(event.target);  
            console.log(data);
            fetch("{{$menu['baseURL']."/auth/reset"}}", {  
                method: "post", 
                body: data,
            })
            .then((res) => res.json())
            .then((json) => {
                hideLoader();
                if(json.status){
                    document.querySelector("#successMessage").innerHTML = json.message;
                    
                    setTimeout(() => {
                        document.querySelector("#successMessage").innerHTML = "";
                        location.href = "{{$menu['baseURL']}}/login";
                    }, "8000");
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