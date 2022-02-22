<?php 
// on active les variables de session
session_start(); 

// on initialise une variable secure_id
$_SESSION["secure_id"] = md5(time());

// on initialise la variable de tentative max 
$_SESSION["tentative_app"] = intval($_SESSION['tentative_app']);


// on regarde di la variable crée avec la page de connexion est créé
if( isset($_SESSION["logged_in"]["iduser"])){
    // si elle est créé alors on initialise la variable verif_co avec son id
    $verif_co = $_SESSION["logged_in"]["iduser"];

    $type = $_SESSION["logged_in"]["type"];

}else{
    // si elle n'est pas crée alors la variable verif_co est à 0
    $verif_co = 0;
    // on crée une session invite pour les user qui ne se connecte pas 
    $type = "invite";

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Bioshock</title>
</head>
<body>
<!-- on recup le fichier du header et on l'affiche  -->
<?php require_once('assets/template/header.php'); ?>

<?php


// on regarde si dans l'url la variable existe et on verifie 
// si le fichier demander grace a la variable dans url existe aussi
if(isset($_GET['page']) && file_exists("assets/php/".$_GET['page'].'.php') ){
    
    // on recupère le fichier et on l'affiche sur la page
    require_once("assets/php/".$_GET['page'] .".php");

}else{
    // si le fichier et la variable n'existe pas alors on retourne a l'accueil
    require_once('assets/php/home.php');

}
?>

<?php require_once('assets/template/footer.php'); ?>
<!-- on recup le fichier du footer et on l'affiche  -->

</body>
</html>