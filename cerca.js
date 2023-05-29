/*Piergaetano Di Vita O46001380*/

function onResponse(response)
{   
    console.log();
    return response.json();
}

function onJsonAnime(json)
{
    console.log('JSON ricevuto');
    console.log(json);
    const ANIME = document.querySelector('#anime');
    ANIME.innerHTML = '';
    const anime = json.data[0].attributes;
    const title = document.createElement('h2');
    const original_title = document.createElement('h1');
    const img = document.createElement('img');
    const descrizione = document.createElement('p');
    title.textContent = anime.titles.en;
    original_title.textContent = anime.titles.en_jp;
    img.src = anime.coverImage.original;
    descrizione.textContent = anime.description;
    ANIME.appendChild(title);
    ANIME.appendChild(original_title);
    ANIME.appendChild(img);
    ANIME.appendChild(descrizione);
}

const API_KEY = 'k_cm3k1pba';

function onJsonFilm(json)
{
    console.log(json);
    const film = document.querySelector('#film');
    film.innerHTML = '';
    const film_json = json.results[0];
    const title = document.createElement('h2');
    const anno = document.createElement('h1');
    const img = document.createElement('img');


    title.textContent = film_json.title;
    anno.textContent = film_json.description;
    img.src = film_json.image;
    
    film.appendChild(title);
    film.appendChild(anno);
    film.appendChild(img);
    const url = 'https://imdb-api.com/en/API/MetacriticReviews/' + API_KEY + '/' + film_json.id;
    fetch(url).then(onResponse).then(onJsonDescrizioneFilm);
   
}

function onConfermaAggiunta(check){

    if(check == "Ok"){
    const checked = document.querySelector(".preferito");
    checked.style.backgroundImage="url(https://svgsilh.com/svg/152185.svg)";
    const messaggio = document.querySelector(".messaggio");
    messaggio.textContent="Aggiunto";
    } else {
    const messaggio = document.querySelector(".messaggio");
    messaggio.textContent="Qualcosa è andato storto";
    }
}

function gestisciPreferiti(){
    const n1 = document.querySelector("#film h2")
    const Titolo = n1.innerHTML;
    
    const n2 = document.querySelector("#film h1");
    const anno = n2.innerHTML;
    
fetch("gestisci_preferiti.php?controllo=check&titolo="+Titolo+"&anno="+anno).then(onResponse).then(stampaCheck);
}

function stampaCheck(object){
   
    if(object == "Non trovato"){ 

    const film = document.querySelector('#film');
    const aggiungi = document.createElement('div');
    aggiungi.classList.add("messaggio");
    aggiungi.textContent="Clicca il più per aggiungerlo ai film da guardare";

    const preferito = document.createElement('div');
    preferito.classList.add("preferito");
    
    film.prepend(aggiungi);
    film.prepend(preferito);
    preferito.addEventListener("click", aggiungiAiPreferiti);

}else {     
        const film = document.querySelector('#film');

        const aggiungi = document.createElement('div');
        aggiungi.classList.add("messaggio");
        aggiungi.textContent="Già aggiunto. Clicca per rimuoverlo";
    
        const preferito = document.createElement('div');
        preferito.classList.add("elimina");

        film.prepend(aggiungi);
        film.prepend(preferito);
        preferito.addEventListener("click", eliminaDaiPreferiti);
        
    }
}

function aggiungiAiPreferiti(){

    const n1 = document.querySelector("#film h2")
    const Titolo = n1.innerHTML;
    
    const n2 = document.querySelector("#film h1");
    const anno = n2.innerHTML;
    
    const n3 = document.querySelector("#film img");
    const immagine = n3.src;
   
    const n4 = document.querySelector("#film h3");
    const autore = n4.innerHTML;
    
    const n5 = document.querySelector("#film p");
    const descrizione = n5.innerHTML;
    fetch("gestisci_preferiti.php?controllo=add&titolo="+Titolo+"&anno="+anno+"&immagine="+immagine+"&autore="+autore+"&descrizione="+descrizione).then(onResponse).then(onConfermaAggiunta);
}

function eliminaDaiPreferiti(){
    
    const n1 = document.querySelector("#film h2")
    const Titolo = n1.innerHTML;
    
    const n2 = document.querySelector("#film h1");
    const anno = n2.innerHTML;
    
    fetch("gestisci_preferiti.php?controllo=del&titolo="+Titolo+"&anno="+anno).then(onResponse).then(onConfermaCancellato);
}

function onConfermaCancellato(check){
    if(check == "Ok"){
        const checked = document.querySelector(".elimina");
        checked.style.backgroundImage="url(https://svgsilh.com/svg/152185.svg)";
        const messaggio = document.querySelector(".messaggio");
        messaggio.textContent="Eliminato";
        } else {
        const messaggio = document.querySelector(".messaggio");
        messaggio.textContent="Qualcosa è andato storto";
        }
}


function onJsonDescrizioneFilm(json)
{
   
    console.log(json);

    const film = document.querySelector('#film');
    const film_json = json.items[0];
    const autore = document.createElement('h3');
    const descrizione = document.createElement('p');
  
    if(film_json == undefined){
        autore.textContent="";
        descrizione.textContent="";
    }else{
        autore.textContent = film_json.author;
        descrizione.textContent = '"' + film_json.content + '"';
    }
    film.appendChild(autore);
    film.appendChild(descrizione);
    gestisciPreferiti();
}

function ricercaFilm(event)
{
    event.preventDefault();
    const film_input = film_form.querySelector('#film_text');
    const film_value = encodeURIComponent(film_input.value);
    console.log('Cerco: ' + film_value);
    const url = 'https://imdb-api.com/en/API/SearchMovie/' + API_KEY + '/' + film_value;
    console.log('URL: ' + url);
    fetch(url).then(onResponse).then(onJsonFilm);
}

function ricercaAnime(event)
{
    event.preventDefault();
    const cercata = document.getElementById("anime_text");
    fetch("api_private.php?q="+encodeURIComponent(encodeURIComponent(cercata.value))).then(onResponse).then(onJsonAnime);
    /*
    Faccio un doppio encode perché 
    in php(o a causa di get?) al valore di 'q' viene tolto l'encoding.
    Se passo ?q=One%20Piece in php in $_GET['q']
    viene salvato "One Piece". Quindi è come se php(o c'entra il 
    metodo get..)togliesse l'encode fatto. Il risultato è che la richiesta 
    all'api non andrà a buon fine. Per "risolvere" il problema
    faccio un doppio encode su javascript.
    */
}

const film_form = document.querySelector('#film_form');
const anime_form = document.querySelector('#anime_form');

film_form.addEventListener('submit', ricercaFilm);
anime_form.addEventListener('submit', ricercaAnime);

function onfilmClick(event)
{
    console.log('Stai scegliendo un film');
    ripulisci();
    const film_form = document.querySelector('#film_form');
    

    film_form.classList.remove('nascondi');
    film_reset.classList.remove('nascondi');
}


function onAnimeClick(event)
{
    console.log('Stai scegliendo un anime');
    ripulisci();
    const anime_form = document.querySelector('#anime_form');
   
    
    anime_form.classList.remove('nascondi');
    anime_reset.classList.remove('nascondi');
}

function ripulisci()
{
    const film = document.querySelector('#contenitore_film');
    const anime = document.querySelector('#contenitore_anime');
   
    const film_form = document.querySelector('#film_form');
    const anime_form = document.querySelector('#contenitore_anime');
    const domanda = document.querySelector('#domanda');
    
    film.classList.add('nascondi');
    anime.classList.add('nascondi')
    
    domanda.classList.add('nascondi');
    film_form.classList.add('nascondi');
    anime_form.classList.add('nascondi');
}

function onAnimeResetClick(event)
{
    const film = document.querySelector('#anime');
    film.innerHTML = '';
    anime_reset.classList.add('nascondi');
    anime_form.classList.add('nascondi');
    onfilmClick();
}

function onfilmResetClick(event)
{
    const film = document.querySelector('#film');
    film.innerHTML = '';
    film_reset.classList.add('nascondi');
    onAnimeClick();
}


const contenitore_film = document.querySelector('#contenitore_film div');
const anime_reset = document.querySelector('#anime_reset');
const anime_box = document.querySelector('#contenitore_anime div');
const film_reset = document.querySelector('#film_reset');


contenitore_film.addEventListener('click', onfilmClick);
anime_box.addEventListener('click', onAnimeClick);
anime_reset.addEventListener('click', onAnimeResetClick);
film_reset.addEventListener('click', onfilmResetClick);
