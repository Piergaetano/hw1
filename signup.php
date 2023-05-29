<?php 
/*Piergaetano Di Vita O46001380*/
require_once 'auth.php';


    if (checkAuth()) {
        header("Location: home.php");
        exit;
    }  

    if(!empty($_POST['Nome']) && !empty($_POST['Cognome']) && !empty($_POST['Nome_Utente']) && !empty($_POST['Email']) 
     && !empty($_POST['Password']) && !empty($_POST['Conferma_Password']))
     {
    

        $error = array();
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

         # NomeUtente
        // Controlla che il nome Utente rispetti il pattern specificato
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['Nome_Utente'])) {
            $error[] = "Username non valido";
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['Nome_Utente']);
            // Cerco se l'username esiste già o se appartiene a una delle 3 parole chiave indicate
            $query = "SELECT username FROM users WHERE username = '$username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Username già utilizzato";
            }
        }
        # PASSWORD

    if( !preg_match( '/(?=.{8})(?=.*[a-z])(?=.*[A-Z])(?=.*[1-9])(?=.*[!@#$%^&*()\-_=+{};:,<.>])/', $_POST["Password"] ) ) {
            $error[] = "Sono richiesti: 1 Maiuscola, 1 Minuscola, min 8 caratteri, un simbolo speciale";
        }
    
        # CONFERMA PASSWORD
        if (strcmp($_POST["Password"], $_POST["Conferma_Password"]) != 0) {
            $error[] = "Le password non coincidono";
        }
        # EMAIL
        if (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL) ) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['Email']));
            $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già utilizzata";
            }
        }

        # UPLOAD DELL'IMMAGINE DEL PROFILO  
        if (count($error) == 0) { 
            if ($_FILES['Immagine_Profilo']['size'] != 0) {
                $file = $_FILES['Immagine_Profilo'];
                $type = exif_imagetype($file['tmp_name']);
                $allowedExt = array(IMAGETYPE_PNG => 'png', IMAGETYPE_JPEG => 'jpg', IMAGETYPE_GIF => 'gif');
                if (isset($allowedExt[$type])) {
                    if ($file['error'] === 0) {
                        if ($file['size'] < 7000000) {
                            $fileNameNew = uniqid('', true).".".$allowedExt[$type];
                            $fileDestination = 'assets/fotoprofilo/'.$fileNameNew;
                            move_uploaded_file($file['tmp_name'], $fileDestination);
                        } else {
                            $error[] = "L'immagine non deve avere dimensioni maggiori di 7MB";
                        }
                    } else {
                        $error[] = "Errore nel carimento del file";
                    }
                } else {
                    $error[] = "I formati consentiti sono .png, .jpeg, .jpg e .gif";
                }
            }else{
                echo "Non hai caricato nessuna immagine";
            }
        }

        # REGISTRAZIONE NEL DATABASE
        if (count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['Nome']);
            $surname = mysqli_real_escape_string($conn, $_POST['Cognome']);

            $password = mysqli_real_escape_string($conn, $_POST['Password']);
            $password = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO users(username, email, password, name, surname, picture, copertina) VALUES('$username', '$email', '$password', '$name', '$surname', '$fileDestination','assets\fotocopertina\cinema')";
            if (mysqli_query($conn, $query)) {
                $_SESSION["_session_username"] = $_POST["Nome_Utente"];
                $_SESSION["_session_user_id"] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
            
        }
        mysqli_close($conn);
    }    else if (isset($_POST["username"])) {
        $error = array("Riempi tutti i campi");
    }

?>


<html>

    <head>
        <script src='signup.js' defer></script>
        <link rel='stylesheet' href="signup.css">
    </head>

   
    <body>
    
    <section id="ContenitoreSignUp">
        <h1>Registrati</h1>
        <form name="sign_up" enctype="multipart/form-data" method="post">
                
            <div id="Nome">
                <label>Nome</label> 
                <input type="text" name="Nome" placeholder="Inserisci il tuo nome">
                <span></span>
            <div>   
            
            <div id="Cognome">  
                <label>Cognome</label>
                <input type="text" name="Cognome" placeholder="Inserisci il tuo cognome">
                <span></span>
            <div>  
                
            <div id="Nome_utente">  
                <label>Nome utente</label>
                <input type="text" name="Nome_Utente" placeholder="Inserisci il tuo nome utente">
                <span></span>
            <div>    
                
            <div id="Email">  
                <label>Email</label>
                <input type="text" name="Email" placeholder="Inserisci la tua email">
                <span></span>
            <div>     
                
            <div id="Password">  
                <label>Password</label>
                <input type="password" name="Password" placeholder="Inserisci la tua password">
                <span class="hidden"></span>
            <div>   
                
            <div id="Conferma_Password">
                <label>Conferma Password</label>
                <input type="password" name="Conferma_Password" placeholder="Conferma la tua password">
                <span></span>
            <div> 
              
            
            <div id="Scegli_Immagine">
                <label>Scegli un'immagine profilo</label>
                <input type="file" name="Immagine_Profilo" accept='.jpg, .jpeg, image/gif, image/png', id="upload_original">
                <span></span>
            <div>
            
            <?php if(isset($error)) {
                    foreach($error as $err) {
                        echo "<div class='errorj'><img src='./assets/close.svg'/><span>".$err."</span></div>";
                    }
                } ?>


            
        <div class = "pulsanti">
            <div class="submit">
                    <input type='submit' value="Registrati" id="submit">
            </div>

            <div class="submit">
                <a href='login.php' class="submit">Login</a>
            </div>
        </div>
        </form>

    </section>


    </body>



</html>