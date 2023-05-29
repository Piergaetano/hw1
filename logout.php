<?php
/*Piergaetano Di Vita O46001380*/
session_start();

session_destroy();

header("Location: login.php");
exit;
?>