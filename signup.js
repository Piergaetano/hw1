/*Piergaetano Di Vita O46001380*/
function controllaNome(event){
    const input = event.currentTarget;
    if(input.value.length == 0){
        const span = document.querySelector("#Nome span");
        span.textContent = "Devi inserire un nome";
    }else{
        const span = document.querySelector("#Nome span");
        span.textContent = "";
    }
}

function controllaCognome(event){
    const input = event.currentTarget;
    if(input.value.length == 0) {   
        const span = document.querySelector("#Cognome span");
        span.textContent = "Devi inserire un cognome";
}else{
    const span = document.querySelector("#Cognome span");
    span.textContent = "";
}
}

function onResponse(response){
if(!response.ok) return null;
return response.json();
}

function onJsonUsername(json){
    if(json.exists){
        const span = document.querySelector("#Nome_Utente span"); 
        span.textContent = "Questo nome utente è già utilizzato"; 
    }
}

function controllaNome_Utente(event){
    const input = event.currentTarget;
    
    if(input.value.length == 0)
    {
        const span = document.querySelector("#Nome_Utente span");
        span.textContent = "Devi inserire un nome utente";
    }else{
            const span = document.querySelector("#Nome_Utente span");
            span.textContent = "";
            fetch("controlla_username.php?Nome_Utente="+encodeURIComponent(input.value)).then(onResponse).then(onJsonUsername);
    }
}


function onJsonEmail(json){
    if(json.exists){
        const span = document.querySelector("#Email span");
        span.textContent = "Questa email è già utilizzata";
    }
}

function controllaEmail(event){
    const input = event.currentTarget;
    if(input.value.length == 0) {
        const span = document.querySelector("#Email span");
        span.textContent = "Devi inserire una email";
    }else{
            const span = document.querySelector("#Email span");
            span.textContent = "";
            fetch("controlla_email.php?Email="+encodeURIComponent(input.value)).then(onResponse).then(onJsonEmail);
    }

}


function controllaPassword(event){
    const input = event.currentTarget;
    const strengthBadge = document.querySelector('#Password span');
    const strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})');
    const mediumPassword = new RegExp('((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))');

    if(input.value.length == 0) {
        const span = document.querySelector("#Password span");
        span.classList.remove("red");
        span.classList.remove("blue");
        span.classList.remove("green");
        span.textContent = "Devi inserire una password";
    }else{
        const span = document.querySelector("#Password span");
        span.textContent = "";
    }
        if(strongPassword.test(event.currentTarget.value)) {

            /*Almeno 8 caratteri tra cui: 1 lettera minuscola, 1 maiuscola
            un carattere speciale ed un numero.*/
            strengthBadge.textContent = 'Password Forte';
            strengthBadge.classList.remove("blue");
            strengthBadge.classList.remove("red");
            strengthBadge.classList.remove("hidden");
            strengthBadge.classList.add("green");
            document.querySelector("#ContenitoreSignUp").style.height="600px";
        } else if(mediumPassword.test(event.currentTarget.value)) {
            /*
            Se ha 6 caratteri tra cui 1 maiuscola,1 una minuscola ed 1 
            carattere speciale ed 1 numero oppure non ha numeri ma 
            soddisfa tutti gli altri requisiti
            */
            strengthBadge.textContent = 'Password Media';
            strengthBadge.classList.remove("green");
            strengthBadge.classList.remove("red");
            strengthBadge.classList.remove("hidden");
            strengthBadge.classList.add("blue");
            document.querySelector("#ContenitoreSignUp").style.height="600px";
        } else {
            strengthBadge.textContent = 'La password deve contenere: 1 Simbolo speciale, 1 Lettera maiuscola';
            strengthBadge.classList.remove("blue");
            strengthBadge.classList.remove("green");
            strengthBadge.classList.remove("hidden");
            strengthBadge.classList.add("red");
            document.querySelector("#ContenitoreSignUp").style.height="800px";
        }
}

function controllaConferma_Password(event){
    const input = event.currentTarget;
    if(input.value.length == 0) {
        const span = document.querySelector("#Conferma_Password span");
        span.textContent = "Devi inserire la conferma password";
    } else{
        const span = document.querySelector("#Conferma_Password span");
        span.textContent = "";
    }
}


document.querySelector("#Nome input").addEventListener("blur",controllaNome);
document.querySelector("#Cognome input").addEventListener("blur",controllaCognome);
document.querySelector("#Nome_Utente input").addEventListener("blur",controllaNome_Utente);
document.querySelector("#Email input").addEventListener("blur",controllaEmail);
document.querySelector("#Password input").addEventListener("blur",controllaPassword);
document.querySelector("#Conferma_Password input").addEventListener("blur",controllaConferma_Password);