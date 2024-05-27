function submitForm(url,redirect)
{
    showLoader();
    event.preventDefault();
    
    const data = new FormData(); 
    
    event.target.querySelectorAll("input").forEach(input => {
        if(input.dataset.object){ 
            data.append(input.name,JSON.parse(input.dataset.object).id);
        }else{ 
            data.append(input.name,input.value);
        }
    });

    data.append("dateTimeBegin",event.target.querySelector("#date").value+" "+event.target.querySelector("#begin").value); 
    data.append("dateTimeEnd",event.target.querySelector("#date").value+" "+event.target.querySelector("#end").value); 

    fetch(url, { 
        headers: { 
            "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },  
        method: "post", 
        body: data,
    })
    .then((res) => res.json())
    .then((json) => {
        
        hideLoader();

        if(json.status){
            location.href = redirect;
        }
        else{
            document.querySelector("#errorMessage").innerHTML = json.message;
            
            setTimeout(() => {
                document.querySelector("#errorMessage").innerHTML = "";
            }, "10000");
        }
    })
    .catch((err) => console.error("error:", err)); 
}

function autocomplete(inp, arr, callback) { 
    var currentFocus; 
    
    inp.addEventListener("input", (e) => {

        if(inp.dataset.object){
            if(JSON.parse(inp.dataset.object).name.trim() != inp.value.trim()){
                inp.dataset.object = "";
            }
        }
        
        var a, b, i, indexed = 0,exist = false, val = e.target.value; 

        closeAllLists();

        if (!val) { 
            inp.dispatchEvent(new Event("click"));    
            return false;
        }

        currentFocus = -1;
       
        a = document.createElement("DIV");
        a.setAttribute("id", e.target.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
         
        e.target.parentNode.appendChild(a);
         
        for (i = 0; i < arr.length; i++) {

            if (arr[i].name.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                if(!exist){
                    exist = true;
                }

                b = document.createElement("DIV"); 
                b.innerHTML = "<strong>" + arr[i].name.substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].name.substr(val.length); 
                b.innerHTML += "<input type='hidden' value='"+arr[i].name+"'  data-object='" + JSON.stringify(arr[i]) + "'>"; 
                b.addEventListener("click", (event) => {
                    inp.value = event.target.getElementsByTagName("input")[0].value; 
                    inp.dataset.object = event.target.getElementsByTagName("input")[0].dataset.object;
                     
                    if(callback)callback(inp);
                    closeAllLists()
                });
                a.appendChild(b);

                if(indexed == 2)
                {
                    break;
                }

                indexed++;
            }
        }

        if(!exist){
            b = document.createElement("DIV"); 
            b.innerHTML = "Elemento no encontrado"; 
            a.appendChild(b);
        } 
    });

    inp.addEventListener("click", (e) => { 
        e.stopPropagation();
        var a, b, i, exist = false, val = e.target.value; 

        closeAllLists(); 
       
        a = document.createElement("DIV");
        a.setAttribute("id", e.target.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
         
        e.target.parentNode.appendChild(a);
         
        for (i = 0; i < arr.length; i++) {

            if(i == 3)
            {
                break;
            }
            
            if (!val) { 
                b = document.createElement("DIV"); 
                b.innerHTML = "<strong>" + arr[i].name + "</strong>"; 
                b.innerHTML += "<input type='hidden' value='" + arr[i].name + "'  data-object='" + JSON.stringify(arr[i]) + "'>"; 

                b.addEventListener("click", (event) => { 
                    inp.value = event.currentTarget.getElementsByTagName("input")[0].value; 
                    inp.dataset.object = event.currentTarget.getElementsByTagName("input")[0].dataset.object;

                    if(callback)callback(inp);
                    closeAllLists()
                });
                a.appendChild(b);
            }
            else
            {
                if (arr[i].name.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    if(!exist){
                        exist = true;
                    }

                    b = document.createElement("DIV"); 
                    b.innerHTML = "<strong>" + arr[i].name.substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].name.substr(val.length); 
                    b.innerHTML += "<input type='hidden' value='" + arr[i].name + "' data-object='" + JSON.stringify(arr[i]) + "'>"; 

                    b.addEventListener("click", (e) => { 
                        inp.value = event.target.getElementsByTagName("input")[0].value; 
                        inp.dataset.object = event.target.getElementsByTagName("input")[0].dataset.object;
                         
                        if(callback)callback(inp);
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
            
        }
    });
    
    inp.addEventListener("focusout", (event) => {
        event.target.value = event.target.dataset.object ? event.target.value : "";
    });
/*
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
      
            currentFocus++;
            addActive(x);
        } else if (e.keyCode == 38) {
            currentFocus--; 
            addActive(x);
        } else if (e.keyCode == 13) {
        
            e.preventDefault();
            if (currentFocus > -1) { 
                if (x) x[currentFocus].click();
            }
        }
    });*/

    function addActive(x) {
        if (!x) return false;
        
        removeActive(x);

        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
       
        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) { 
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(elmnt) { 
        var x = document.getElementsByClassName("autocomplete-items");

        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
     
    document.addEventListener("click", function (e) {  
        closeAllLists(e.target);
    });
}

autocomplete(document.querySelector("#clients"), clients);
autocomplete(document.querySelector("#services"), services);
autocomplete(document.querySelector("#users"), users);

if(appointment.id){
    const client = clients.filter(client => client.id == appointment.client_id);
    const service = services.filter(service => service.id == appointment.service_id);
    const user = users.filter(user => user.id == appointment.user_id);

    if(client.length != 0){
        let eClient = document.querySelector("#clients");
        eClient.dataset.object = JSON.stringify(client[0]); 
        eClient.value = client[0].name;
    }

    if(service.length != 0){
        let eService = document.querySelector("#services");
        eService.dataset.object = JSON.stringify(service[0]); 
        eService.value = service[0].name;
    }

    if(user.length != 0){
        let eUser = document.querySelector("#users");
        eUser.dataset.object = JSON.stringify(user[0]); 
        eUser.value = user[0].name;
    }
    
}

if(user.role == "0"){
    document.querySelector("#users").readOnly = true;
    document.querySelector("#users").value = user.name;
    document.querySelector("#users").dataset.object = JSON.stringify(user);
}