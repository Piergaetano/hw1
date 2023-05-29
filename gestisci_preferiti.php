<?php
/*Piergaetano Di Vita O46001380*/     

require_once 'auth.php';
if (!checkAuth()) {
    header("Location: login.php");
    exit;
}  

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    /*
    $_GET['controllo'] = add aggiungi
    $_GET['controllo'] = check controlla
    $_GET['controllo'] = del cancella
    */


    if($_GET['controllo'] == "check"){
        $titolo1 = $_GET['titolo'];
        $anno1 = $_GET['anno'];
        $username = mysqli_real_escape_string($conn, $_SESSION['_session_username']);

        $query = "SELECT * from film join preferiti ON film.id=preferiti.id_film JOIN users ON users.username = preferiti.utente where film.titolo = '".$titolo1."' AND users.username='".$username."'AND film.anno= '".$anno1."'";
        $res = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($res) == '0'){
          echo json_encode("Non trovato");  
          exit;
        } else {
            echo json_encode("Trovato");
            exit;
        }
    }
    
    if($_GET['controllo'] == "add") {

    $titolo1 = $_GET['titolo'];
    $anno1 = $_GET['anno'];
    $immagine1 = $_GET['immagine'];
    $autore1 = $_GET['autore'];
    $descrizione1 = $_GET['descrizione'];
    

    $username = mysqli_real_escape_string($conn, $_SESSION['_session_username']);
    $titolo = mysqli_real_escape_string($conn, $titolo1);
    $anno = mysqli_real_escape_string($conn, $anno1);
    $immagine = mysqli_real_escape_string($conn, $immagine1);
    $autore = mysqli_real_escape_string($conn, $autore1);
    $descrizione = mysqli_real_escape_string($conn,$descrizione1);
       
    $query= "SELECT * FROM film WHERE titolo ='".$titolo."' AND anno = '".$anno."'";
    $res = mysqli_query($conn, $query);
   
    if(mysqli_num_rows($res) == "0"){
        $query1 = "INSERT INTO film(titolo, anno, immagine, autore, descrizione) VALUES('$titolo', '$anno', '$immagine', '$autore', '$descrizione')";
            mysqli_query($conn, $query1);
            $id = mysqli_insert_id($conn);
        }else{
            $entry = mysqli_fetch_assoc($res);
            $id = $entry['id'];
        }
            $query2 = "INSERT INTO preferiti(utente, id_film) VALUES('$username', '$id')";
            mysqli_query($conn, $query2);
            mysqli_close($conn);
            echo json_encode("Ok");
            exit;
    }


    if($_GET['controllo'] == "del") {
        $titolo1 = $_GET['titolo'];
        $anno1 = $_GET['anno'];
        
    
        $username = mysqli_real_escape_string($conn, $_SESSION['_session_username']);
        $titolo = mysqli_real_escape_string($conn, $titolo1);
        $anno = mysqli_real_escape_string($conn, $anno1);
        
       
        $query= "SELECT id_film from film join preferiti on film.id = preferiti.id_film where film.titolo = '".$titolo."' AND film.anno = '".$anno."'";
        $res = mysqli_query($conn, $query);
        $entry = mysqli_fetch_assoc($res);

        $queryd = "DELETE FROM preferiti where id_film= '".$entry['id_film']."' AND utente= '".$username."'";

                mysqli_query($conn, $queryd);
                mysqli_close($conn);
                echo json_encode("Ok");
                exit;
        }




   ?>