<?php
//si different de admin alors on renvoie vers la page connexion
if($type != "admin"){
    header("location: index.php?page=connexion");
}
?>


<?php

require("../../bdd/bddconfig.php");

$titre = htmlspecialchars(addslashes($_POST["titre"]));
$resume = htmlspecialchars(addslashes($_POST["resume"]));
$id = htmlspecialchars($_POST["idarticle"]);

try{

    $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
 
    $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $recup = $objBdd->prepare("UPDATE `article` SET `titre`  = :titre,`resume` = :resume WHERE `idarticle` = :id ");
    
    
    $recup->bindParam(':id' , $id , PDO::PARAM_STR);
    $recup->bindParam(':titre' , $titre , PDO::PARAM_STR);
    $recup->bindParam(':resume' , $resume , PDO::PARAM_STR);
   
    $recup->execute();
    
    header('Location: ../../../index.php');

}catch( Exception $prmE){

    die("ERREUR : " . $prmE->getMessage());

}