/*Piergaetano Di Vita O46001380*/       
function onCaricaFilm(film_json){

for (var i=0; i<film_json.length; i++){

const article = document.querySelector("article");
const contenitore_film = document.createElement("div");
contenitore_film.classList.add('contenitore');

const title = document.createElement('h3');
const anno = document.createElement('h4');
const img = document.createElement('img');
const autore = document.createElement('h4');
const descrizione = document.createElement('p');

title.textContent = film_json[i].titolo;
anno.textContent = film_json[i].anno;
img.src = film_json[i].immagine;
autore.textContent = film_json[i].autore;
descrizione.textContent = film_json[i].descrizione;


contenitore_film.appendChild(title);
contenitore_film.appendChild(anno);
contenitore_film.appendChild(img);
contenitore_film.appendChild(autore);
contenitore_film.appendChild(descrizione);


const elimina = document.createElement("div");
const messaggio = document.createElement('p');
messaggio.textContent="Cancella";
elimina.appendChild(messaggio);
elimina.classList.add("cancella");
contenitore_film.appendChild(elimina);
article.appendChild(contenitore_film);

elimina.addEventListener("click", eliminaPreferito);
    
    }
}

function onResponse(response){
    return response.json();
}

function caricaFilm(){
    fetch("carica_film.php").then(onResponse).then(onCaricaFilm);
}

caricaFilm();

function eliminaPreferito(event){
fetch("gestisci_preferiti.php?controllo=del&titolo="+this.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.textContent+"&anno="+this.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.textContent).then(onResponse);
this.parentNode.remove();
}