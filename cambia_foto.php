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


# CAMBIA L'IMMAGINE DEL PROFILO  
   
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
                    $query2 = "UPDATE users SET picture = '$fileDestination' WHERE username = '".$username."'";
                   
                    if($res = mysqli_query($conn, $query2)){
                    header("Location: profilo.php");
                    mysqli_close($conn);
                    mysqli_free_result($res);
                    exit;
                }else{
                    echo "Errore di connessione al database";
                }
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
        $error[] = "Immagine non trovata";    
    }
    
    echo json_encode($error);
?>
