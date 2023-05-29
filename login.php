<?php 
/*Piergaetano Di Vita O46001380*/
require_once 'auth.php';

if (checkAuth()) {
    header("Location: home.php");
    exit;
}  


if(isset($_POST["Nome_Utente"]) && isset($_POST["Password"]))
{
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
    $username = mysqli_real_escape_string($conn, $_POST["Nome_Utente"]);
    $query = "SELECT * FROM users WHERE username = '".$username."'";

    $res = mysqli_query($conn, $query);

    if(mysqli_num_rows($res) > 0){
        $entry = mysqli_fetch_assoc($res);
        if(password_verify($_POST['Password'], $entry['password']) ){
        $_SESSION["_session_username"] = $_POST["Nome_Utente"];
        $_SESSION['_session_user_id'] = $entry['id'];
        header("Location: home.php");
        mysqli_free_result($res);
        mysqli_close($conn);
        exit;
        }
    }
        $error = "Username e/o password errati.";
    
    }
    else if (isset($_POST["username"]) || isset($_POST["password"])) {
        // Se solo uno dei due è impostato
        $error = "Inserisci username e password.";
    }

?>


<html>

    <head>
        <link rel="stylesheet" href="login.css">
        <script src='login.js' defer></script>
    </head>


    <body>

    <section id="ContenitoreLogin">
          
        <h1>Accedi</h1>
        <?php
                // Verifica la presenza di errori
                if (isset($error)) {
                    echo "<p class='error'>$error</p>";
                }
                
            ?>
        <form name="log_in" method="post">
                           
            <div id="Nome_utente">  
                <label>Nome utente</label>
                <input type="text" name="Nome_Utente" placeholder="Inserisci il tuo nome utente">
                <span></span>
            <div>     
                
            <div id="Password">  
                <label>Password</label>
                <input type="password" name="Password" placeholder="Inserisci la tua password">
                <span class="hidden"></span>
            <div>   
            

            <div class = "pulsanti">
                
                <div class="submit">
                        <input type='submit' value="Accedi" id="submit">
                </div>

                <div class="submit">
                    <a href='signup.php' class="submit">Registrati</a>
                </div>
            </div>

        </form>

    </section>

    </body>

</html>

