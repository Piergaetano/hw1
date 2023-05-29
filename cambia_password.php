<?php 
/*Piergaetano Di Vita O46001380*/

require_once 'auth.php';
if (!checkAuth()) {
    header("Location: login.php");
    exit;
}  
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
    $username = mysqli_real_escape_string($conn, $_SESSION['_session_username']);
    $query = "SELECT * FROM users WHERE username = '".$username."'";
    $res= mysqli_query($conn, $query);
    $error=array();

    if(mysqli_num_rows($res) >0){
    $entry = mysqli_fetch_assoc($res);
    mysqli_free_result($res);
    }else{
        $error[]="Errore(1) di connessione al database";
    }


    if(isset($_POST['vecchia']) && isset($_POST['nuova']) && isset($_POST['conferma'])){
       
        $passwordVecchia = password_hash($_POST['vecchia'], PASSWORD_BCRYPT);
        $passwordNuova = password_hash($_POST['nuova'], PASSWORD_BCRYPT);
        $passwordConferma = password_hash($_POST['conferma'], PASSWORD_BCRYPT);

        if(!strcmp($_POST['nuova'],$_POST['conferma']) ){
            if(password_verify($_POST['vecchia'], $entry['password'])){
                $query2 = "UPDATE users SET password = '$passwordNuova' WHERE username = '".$username."'";
                if($res = mysqli_query($conn, $query2)){
                    header("Location: profilo.php");
                    mysqli_close($conn);
                    mysqli_free_result($res);
                    exit;
                }else{
                    $error[]= "Errore(2) di connessione al database";
                }
            }else{
                $error[]= "Password attuale sbagliata";
            }
        }else{
            $error[]= "Le due password non coincidono";
        }
    }else{
        $error[]= "Devi compilare tutti i campi";
    }

    echo json_encode($error); #PER EVENTUALE DUBUG
?>