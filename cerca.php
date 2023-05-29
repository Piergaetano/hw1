<?php 
/*Piergaetano Di Vita O46001380*/

require_once 'auth.php';
if (!checkAuth()) {
    header("Location: login.php");
    exit;
}  

?>


<html>
    <head>
        <title>L'Angolo del cinema</title>

        <meta charset="utf-8">
        <link rel="stylesheet" href="cerca.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
        <meta name="viewport"content="width=device-width, initial-scale=1">
        <script src="cerca.js" defer></script>
    </head>
    <body>       
        <nav>
            <div id="logo">L'angolo del Cinema</div>
            <div id="links">
                <a href="home.php">Home</a>
                <a href="Profilo.php">Profilo</a>
                <a href="logout.php">Logout</a>
            </div>
        </nav>
        <header>
            <div id="overlay"></div>
        </header>


        <div id="domanda"><strong>Cosa vuoi cercare?</strong></div>

        <article>
            <div id="contenitore_film" class="contenitore">
                <strong>Film</strong>
                <div></div>
            </div>

            <div class="contenitore" id="contenitore_anime">
                <strong>Anime</strong>
                <div></div>
            </div>
            
            <form id="film_form" class="nascondi">
                Inserisci il nome del film:
                <input type="text" id="film_text">
                <input type="submit" value="Cerca">
            </form>

            <form id="anime_form" class="nascondi">
                Inserisci il nome dell'anime:
                <input type="text" id="anime_text">
                <input type="submit" value="Cerca">
            </form>

            <button id="film_reset" class="nascondi">Cerca un anime</button>
            <button id="anime_reset" class="nascondi">Cerca un film</button>
  
            <div id="film">
            
            </div>

            <div id="anime">

            </div>

        </article>
    

        
        
    </body>
</html>