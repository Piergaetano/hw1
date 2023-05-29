<?php
/*Piergaetano Di Vita O46001380*/     
require_once 'auth.php';
if (!checkAuth()) {
    header("Location: login.php");
    exit;
}  


$conn = mysqli_connect("localhost","root","","primaprova");
$username = mysqli_real_escape_string($conn, $_GET["Nome_Utente"]);
$query = "SELECT username FROM users WHERE username = '$username'";
$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

echo json_encode(array(
    'exists' => mysqli_num_rows($res) > 0? true : false)
);
mysqli_close($conn);


?>