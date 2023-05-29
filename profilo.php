<?php 
/*Piergaetano Di Vita O46001380*/
require_once 'auth.php';
if (!checkAuth()) {
    header("Location: login.php");
    exit;
}  

$error=array();
$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
    $username = mysqli_real_escape_string($conn, $_SESSION['_session_username']);
    $query = "SELECT * FROM users WHERE username = '".$username."'";
    $res = mysqli_query($conn, $query);
    $entry = mysqli_fetch_assoc($res);
    mysqli_free_result($res);
?>



<html>
    <head>
        <title>L'Angolo del cinema</title>

        <meta charset="utf-8">
        
        <link rel="stylesheet" href="profilo.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
        <meta name="viewport"content="width=device-width, initial-scale=1">
        <script src="profilo.js" defer></script>
    </head>
    
    
    
    <body>       
        <nav>
            <div id="logo">L'angolo del Cinema</div>
            <div id="links">
                <a href="home.php">Home</a>
                <a href="cerca.php">Cerca</a>
                <a href="logout.php">Logout</a>
            </div>
        </nav>
        <header>
            <div id="overlay"></div>
        </header>

        <div id="profilo">
            <img id="foto" src="<?php echo $entry['picture']?>">
            <div id="nome">
                <strong><?php
                echo $entry['name'];
                echo " ".$entry['surname'];                
                ?></strong><br>
                <em>Ultimo accesso: <?php echo date("d-m-Y");?></em>
            </div>
        </div>

        <article id="article">

    <div id="contenitoreImpostazioni">
            <h1>Impostazioni</h1>
            <div id="contenitore_password" class="contenitore">
                <strong>Cambia Password</strong>
            </div>

            <div id="contenitore_immagine" class="contenitore">
                <strong>Cambia immagine</strong>
            </div>
            
            <div id="contenitore_copertina" class="contenitore">
                <strong>Cambia copertina</strong>
            </div>           
    </div>

            <form id="password_form" class="nascondi" method="post" action="cambia_password.php">
               
                <div id = "vecchia" class="interni"> 
                    <p>Inserisci la vecchia password:</p>
                    <input type="password" id="cambia_password" name="vecchia">
                    <span></span>
                </div>
                
                <div id="nuova" class="interni"> 
                    <p>Inserisci la nuova password:</p>
                    <input type="password" id="cambia_password" name="nuova">
                    <span></span>
                </div> 
                
                <div id = "conferma" class="interni">
                    <p>Conferma password:</p>
                    <input type="password" id="cambia_password" name="conferma">
                    <span></span>
                </div>
                <br>

                <div id="submit">
                    <input type="submit" value="Cambia password">
                 </div>
                
            
            </form>

            <form id="immagine_form" class="nascondi" method="post" enctype="multipart/form-data" action="cambia_foto.php">
                Sceglie la nuova immagine
                <input type="file" name="Immagine_Profilo" accept='.jpg, .jpeg, image/gif, image/png', id="Immagine_Profilo">
                <input type="submit" value="Carica">
            </form>

            <form id="copertina_form" class="nascondi" method="post" enctype="multipart/form-data" action="cambia_copertina.php">
                Carica la nuova copertina
                <input type="file" name="Immagine_Copertina" accept='.jpg, .jpeg, image/gif, image/png', id="Copertina_text">
                <input type="submit" value="Carica">
            </form>

            <p id="copertina" class="nascondi"><?php echo $entry['copertina']?></p>
            
            <div id="bottoni">
                <button id="password_reset" class="nascondi">Cambia immagine</button>
                <button id="immagine_reset" class="nascondi">Cambia password</button>
                <button id="copertina_reset" class="nascondi">Cambia copertina</button>
            </div>
                
                <div id="immagine"></div>
                <div id="password"></div>
        </article>


    </body>
   
</html>