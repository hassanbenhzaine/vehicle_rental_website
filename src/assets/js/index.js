    const box = document.querySelectorAll('.loadDetails')

    box.forEach(item => 
        item.addEventListener("click", function(){

        var loadDetails = new XMLHttpRequest;
    
        loadDetails.open("POST","index/details",1);
        loadDetails.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
        loadDetails.onload = function(){
            if(this.status = 200){
                if(loadDetails.response){
                    this.innerHTML = loadDetails.response;
                }
            }
            }
    
        loadDetails.send("submit=sumbit");
    })
    
);


