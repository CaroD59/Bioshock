<?php

session_start();


//détruire la session courante
session_destroy();

// on reset les variables
$_SESSION["tentative_app"] = 0;
$_SESSION["secure_id"] = md5(time());

header("Location: index.php")

?>