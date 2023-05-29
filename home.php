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
        
        <link rel="stylesheet" href="home.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
        <meta name="viewport"content="width=device-width, initial-scale=1">
        <script src="home.js" defer></script>
    </head>
    <body>       
        <nav>
            <div id="logo">L'angolo del Cinema</div>
            <div id="links">
                <a href="cerca.php">Cerca</a>
                <a href="Profilo.php">Profilo</a>
                <a href="logout.php">Logout</a>
            </div>
        </nav>
        <header>
            <div id="overlay"></div>
        </header>

        <h1>Film da guardare</h1>
        <h3>Aggiungi film da guardare dalla pagina cerca</h3>
        <article></article>  
    </body>
</html>