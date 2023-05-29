<?php
/*Piergaetano Di Vita O46001380*/
require_once 'auth.php';
if (!checkAuth()) {
    header("Location: login.php");
    exit;
}  


$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
$username = mysqli_real_escape_string($conn, $_SESSION['_session_username']);
$query = "SELECT * from film join preferiti ON film.id=preferiti.id_film where preferiti.utente= '".$username."'";

$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    while( $entry = mysqli_fetch_assoc($res) ){
        $resultArray[] = $entry;
    }
echo json_encode($resultArray);
mysqli_close($conn);
?>