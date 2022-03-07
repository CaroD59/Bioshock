<?php
//si different de admin alors on renvoie vers la page connexion
if($type != "admin"){
    header("location: index.php?page=connexion");
}
?>


<?php

require("../../bdd/bddconfig.php");
// addslashes Ajoute des antislashs dans une chaîne
$titre = htmlspecialchars(addslashes($_POST["titre"]));
$resume = htmlspecialchars(addslashes($_POST["resume"]));
$id = htmlspecialchars($_POST["idarticle"]);

// try va essayer le code avant de l'executer si erreur va dans le catch
try{
    // Connecte a la base mysql
    $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
    // En cas de problème renvoie dans le catch avec l'erreur
    $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     // ici on prepare notre requête SQL
    $recup = $objBdd->prepare("UPDATE `article` SET `titre`  = :titre,`resume` = :resume WHERE `idarticle` = :id ");
    
    // on initialise notre :id avec la variable qui recup l'id
    $recup->bindParam(':id' , $id , PDO::PARAM_STR);
    // on initialise notre :titre avec la variable qui recup le titre
    $recup->bindParam(':titre' , $titre , PDO::PARAM_STR);
    // on initialise notre :resume avec la variable qui recup le resume
    $recup->bindParam(':resume' , $resume , PDO::PARAM_STR);
    // execute la requête SQL
    $recup->execute();
    
    header('Location: ../../../index.php');

}catch( Exception $prmE){

    die("ERREUR : " . $prmE->getMessage());

}