let deletedRecords = document.querySelectorAll(".deleted");
let buttonShowOrHide = document.getElementById("showOrHide")

function hide(){
    [].forEach.call(deletedRecords, function(el){
        el.classList.add("hidden");
    })
    buttonShowOrHide.innerHTML="Mostrar Borrados";
    buttonShowOrHide.addEventListener("click", show())
       
}

function show(){
    [].forEach.call(deletedRecords, function(el){
        el.classList.remove("hidden");
    })
    buttonShowOrHide.innerHTML="Ocultar Borrados";
    buttonShowOrHide.addEventListener("click", hide())    
    
}