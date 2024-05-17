//VARS
let isOpen = false;
const monthsNamesEsp = ["Enero","Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];

//Functions 
const resizeWindow = (event) => { 
    if(window.innerWidth < 768)
    {
        document.querySelector("#NavBarContent").classList.add("absolute","left-[-254px]");  
    }
    else
    { 
        document.querySelector("#NavBarContent").classList.remove("absolute","left-[-254px]");
    }
};

const openNavbar = () => {
    if(window.innerWidth < 768)
    {
        isOpen = !isOpen;

        if(isOpen)
        {
            document.querySelector("#NavBarContent").classList.add("left-[0px]");
            document.querySelector("#NavBarContent").classList.remove("left-[-254px]");
            document.querySelector("#buttonMenu").src = document.querySelector("#buttonMenu").src.replace("Open","Close");
        }
        else
        {
            document.querySelector("#buttonMenu").src = document.querySelector("#buttonMenu").src.replace("Close","Open");
            document.querySelector("#NavBarContent").classList.add("left-[-254px]");
            document.querySelector("#NavBarContent").classList.remove("left-[0px]");
        }
    }
}

function goToURL(url,event)
{
    if(event){
        event.preventDefault();
    }
    
    location.href = url;
}

function getLastElement(idenfity){
   var elements = document.querySelectorAll(idenfity);

   return elements[elements.length-1];
}

function showLoader(){
    document.querySelector("#loader").classList.remove("hidden");;
}

function hideLoader(){
    document.querySelector("#loader").classList.add("hidden");;
}

function showError(message)
{
    var alertString = '<div class="animate-[fade-in_1s_ease-in-out] fixed right-0 top-[50%] w-[300px] fade-in"><div class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">';
    alertString += '<svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">';
    alertString += '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>';
    alertString += '</svg>';
    alertString += '<div class="ms-3 text-sm font-medium">'+message+'</div>';
    alertString += '<button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-2" aria-label="Close">';
    alertString += '<span class="sr-only">Dismiss</span>';
    alertString += '<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">';
    alertString += '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>';
    alertString += '</svg>';
    alertString += '</button>';
    alertString += '</div></div>';

    var temp       = document.createElement('div');
    temp.innerHTML = alertString;

    document.querySelector("body main").appendChild(temp.childNodes[0]); 
}

function seePasswordInput(input){
    let button = event.target;

    while(button?.type != "button"){
        button = button.parentNode;
    } 

    button.classList.add("hidden");
    button.nextElementSibling.classList.remove("hidden");
    
    input.type = input.type == "password" ? "text" : "password";
}

function hidePasswordInput(input){
    let button = event.target;

    while(button?.type != "button"){
        button = button.parentNode;
    } 

    button.classList.add("hidden");
    button.previousElementSibling.classList.remove("hidden");
    
    input.type = input.type == "password" ? "text" : "password";
}

function reformatDate(datetime,format = "d/m/y"){console.log(datetime);
    
    let finalDate = new Date(datetime); 
    finalDate     = new Date(finalDate.toLocaleString("en-US", {timeZone: Intl.DateTimeFormat().resolvedOptions().timeZone}));

    let diffDays  = datediff(new Date(),finalDate)
    let finalString = "";
     
    if(Math.abs(diffDays) < 2){
        switch(diffDays){
            case -1:
                finalString+= "Ayer";
            break;
            case 0: 
                finalString+= "Hoy";
            break;
            case 1:
                finalString+= "Mañana";
            break; 
        }
    }else{
        for(var i = 0; i < format.length; i++ )
        {
            switch(format[i].toLowerCase()){
                case "y":
                    finalString+= finalDate.getFullYear();
                break;
                case "m": 
                    finalString+= finalDate.getMonth() < 10 ? "0"+(finalDate.getMonth()+1) : (finalDate.getMonth()+1);
                break;
                case "d":
                    finalString+= finalDate.getDate() < 10 ? "0"+finalDate.getDate() : finalDate.getDate();
                break;
                default:
                    finalString+=format[i];
                break
            }
        }
    }

    return finalString+" "+(finalDate.getHours() < 10 ? "0"+finalDate.getHours() : finalDate.getHours())+":"+(finalDate.getMinutes() < 10 ? "0"+finalDate.getMinutes() : finalDate.getMinutes());
}

function datediff(first, second) {        
    return Math.round((second - first) / (1000 * 60 * 60 * 24));
}

//Init

window.onresize = resizeWindow;

resizeWindow(); 

onload = (event) => {
    document.querySelector("#loader").classList.add("hidden");;
};