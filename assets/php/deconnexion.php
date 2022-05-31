<?php
// on active les variables de session
session_start();


//détruire la session courante
session_destroy();

// on reset les variables
$_SESSION["tentative_app"] = 0;
// La fonction md5() calcule le hachage MD5 d'une chaîne.
$_SESSION["secure_id"] = md5(time());

header("Location: index.php")

?>