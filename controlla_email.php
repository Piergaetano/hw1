<?php 
/*Piergaetano Di Vita O46001380*/     
require_once 'auth.php';
if (!checkAuth()) {
    header("Location: login.php");
    exit;
}  


$conn = mysqli_connect("localhost","root","","primaprova");
$email = mysqli_real_escape_string($conn, $_GET["Email"]);
$query = "SELECT username FROM users WHERE email = '$email'";
$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

echo json_encode(array(
    'exists' => mysqli_num_rows($res) > 0? true : false)
);
mysqli_close($conn);

?>