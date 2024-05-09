function submitForm(url,redirect)
{
    showLoader();
    event.preventDefault();
    
    const data = new FormData(event.target); 
    
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
            }, "5000");
        }
    })
    .catch((err) => console.error("error:", err)); 
}