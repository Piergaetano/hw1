/*Piergaetano Di Vita O46001380*/
function ripulisci()
{
    const password = document.querySelector('#contenitore_password');
    const immagine = document.querySelector('#contenitore_immagine');
    const copertina = document.querySelector('#contenitore_copertina');
    const h1 = document.querySelector('#contenitoreImpostazioni h1');
    const contenitore = document.querySelector("#contenitoreImpostazioni")
    
    
    const password_form = document.querySelector('#password_form');
    const immagine_form= document.querySelector('#immagine_form');
    const copertina_form = document.querySelector('#copertina_form');

    h1.classList.add('nascondi');
    password.classList.add('nascondi');
    immagine.classList.add('nascondi')
    copertina.classList.add('nascondi');
    contenitore.classList.add('nascondi');
    password_form.classList.add('nascondi');
    immagine_form.classList.add('nascondi');
    copertina_form.classList.add('nascondi');
    contenitore.style.height="0px";
}


function onImmagine(event)
{
    console.log('Cambiando l\'immagine');
    ripulisci();
     
    const contenitore= document.querySelector("#article");
    contenitore.style.height="250px";

    const immagine_form = document.querySelector('#immagine_form');
   
    
    immagine_form.classList.remove('nascondi');

    immagine_reset.classList.remove('nascondi');
    copertina_reset.classList.remove('nascondi');
}


function onPassword(event)
{
    console.log('Stai cambiando l\'immagine');
    ripulisci();
    const password_form = document.querySelector('#password_form');
    
    const contenitore= document.querySelector("#article");
    contenitore.style.height="450px";
    
    password_form.classList.remove('nascondi');

    copertina_reset.classList.remove('nascondi');
    password_reset.classList.remove('nascondi');
}

function onCopertina(event)
{
    ripulisci();
    const copertina_form = document.querySelector('#copertina_form');
    
    const contenitore= document.querySelector("#article");
    contenitore.style.height="250px";
    copertina_form.classList.remove('nascondi');

    password_reset.classList.remove('nascondi');
    immagine_reset.classList.remove('nascondi');
}


function onPassword_reset(event)
{
    const immagine = document.querySelector('#immagine');
    immagine.innerHTML = '';
    password_reset.classList.add('nascondi');
    onImmagine();
}

function onImmagine_reset(event)
{
    const password = document.querySelector('#password');
    password.innerHTML = '';
    immagine_reset.classList.add('nascondi');
    onPassword();
}

function onCopertina_reset(event)
{
    copertina_reset.classList.add('nascondi');
    onCopertina();
}



const contenitore_password = document.querySelector('#contenitore_password');
const contenitore_immagine = document.querySelector('#contenitore_immagine');
const contenitore_copertina = document.querySelector('#contenitore_copertina');

const password_reset = document.querySelector('#password_reset');
const immagine_reset = document.querySelector('#immagine_reset');
const copertina_reset = document.querySelector('#copertina_reset');

contenitore_password.addEventListener("click", onPassword);
contenitore_immagine.addEventListener("click", onImmagine);
contenitore_copertina.addEventListener("click",onCopertina);

password_reset.addEventListener('click', onPassword_reset);
immagine_reset.addEventListener('click',onImmagine_reset);
copertina_reset.addEventListener('click',onCopertina_reset);


const Copertina_text = document.getElementById("copertina");
const path = Copertina_text.innerHTML;
document.querySelector('header').style.backgroundImage="url("+path+")";




function controllaNuova(event){
    const input = event.currentTarget;
    const strengthBadge = document.querySelector('#nuova span');
    const strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})');
    const mediumPassword = new RegExp('((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))');

    if(input.value.length == 0) {
        const span = document.querySelector("#nuova span");
        span.classList.remove("red");
        span.classList.remove("blue");
        span.classList.remove("green");
        span.textContent = "Devi inserire una password";
    }else{
        const span = document.querySelector("#nuova span");
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
        } else {
            strengthBadge.textContent = 'La password deve contenere: 1 Simbolo speciale, 1 Lettera maiuscola, 1 lettera minuscola ed in totale minimo 8 caratteri';
            strengthBadge.classList.remove("blue");
            strengthBadge.classList.remove("green");
            strengthBadge.classList.remove("hidden");
            strengthBadge.classList.add("red");
            const contenitore= document.querySelector("#article");
            contenitore.style.height="550px";
        }
}

function controllaVecchia(event){
    const input = event.currentTarget;
    if(input.value.length == 0) {
        const span = document.querySelector("#vecchia span");
        span.textContent = "Devi inserire la password";
    } else{
        const span = document.querySelector("#vecchia span");
        span.textContent = "";
    }
}


function controllaConferma(event){
    const input = event.currentTarget;
    if(input.value.length == 0) {
        const span = document.querySelector("#conferma span");
        span.textContent = "Devi inserire per conferma";
    } else{
        const span = document.querySelector("#conferma span");
        span.textContent = "";
    }
}




document.querySelector("#vecchia input").addEventListener("blur",controllaVecchia);
document.querySelector("#nuova input").addEventListener("blur",controllaNuova);
document.querySelector("#conferma input").addEventListener("blur",controllaConferma);
