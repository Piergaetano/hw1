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


# UPLOAD DELLA COPERTINA

    if ($_FILES['Immagine_Copertina']['size'] != 0) {
        $file = $_FILES['Immagine_Copertina'];
        $type = exif_imagetype($file['tmp_name']);
        $allowedExt = array(IMAGETYPE_PNG => 'png', IMAGETYPE_JPEG => 'jpg', IMAGETYPE_GIF => 'gif');
        if (isset($allowedExt[$type])) {
            if ($file['error'] === 0) {
                if ($file['size'] < 7000000) {
                    $fileNameNew = uniqid('', true).".".$allowedExt[$type];
                    $fileDestination = 'assets/fotocopertina/'.$fileNameNew;
                    move_uploaded_file($file['tmp_name'], $fileDestination);
                    $query2 = "UPDATE users SET copertina = '$fileDestination' WHERE username = '".$username."'";
                   
                    if($res = mysqli_query($conn, $query2)){
                    header("Location: profilo.php");
                    $_SESSION['copertina']=$fileDestination;
                    mysqli_close($conn);
                    mysqli_free_result($res);
                    exit;
                }else{
                    $error[] = "Errore di connessione al Database";
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

    echo json_encode($error); #per eventuali debug accedendo direttamente al php da url
?>
