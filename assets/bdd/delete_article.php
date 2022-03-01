<?php

$idarticle = htmlspecialchars ($_GET["id"]);

require("bddconfig.php");

try{
        //   connecte a la base mysql
    $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);
    // En cas de probléme renvoie dans le catch avec l'erreeur
    $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $recup = $objBdd->query("DELETE FROM `article` WHERE `idarticle` = $idarticle");

   
    //  Renvoie sur la page index.php
    header('Location: ../../index.php');
    

}catch( Exception $prme){

// Affiche le message d'erreur
  die("ERREUR : " . $prme->getMessage());
}

?>