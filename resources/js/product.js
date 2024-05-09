
function handleChange()
{ 
    document.querySelector("#img-product").src = URL.createObjectURL(event.target.files[0]);
}

function submitForm(url,redirect)
{
    showLoader();
    event.preventDefault();
    
    const data = new FormData(event.target);
    
    if(document.querySelector("#imgProduct").files[0]){ 
        data.append("imgProduct", document.querySelector("#imgProduct").files[0]);
    }
    
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
    .catch((err) => {console.error("error:", err);hideLoader();}); 

}