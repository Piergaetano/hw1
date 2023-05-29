/*Piergaetano Di Vita O46001380*/
function controllaUserName(event){
    const input = event.currentTarget;
    if(input.value.length == 0){
        const span = document.querySelector("#Nome_Utente span");
        span.textContent="Devi inserire il tuo username";
        span.classList.remove("hidden");
    }else{
        const span = document.querySelector("#Nome_Utente span");
        span.textContent=""; 
    }
}


function controllaPassword(event){
    const input = event.currentTarget;
    if(input.value.length == 0){
        const span = document.querySelector("#Password span");
        span.textContent="Devi inserire la password";
        span.classList.remove("hidden"); 
    }
}


document.querySelector("#Nome_Utente input").addEventListener("blur", controllaUserName);
document.querySelector("#Password input").addEventListener("blur", controllaPassword);