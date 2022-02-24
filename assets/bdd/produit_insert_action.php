<?php
session_start();

  
$pseudo = htmlspecialchars($_SESSION["logged_in"]["prenom"]);
$iduser = htmlspecialchars($_SESSION["logged_in"]["iduser"]);
 
$messageDescription =  htmlspecialchars($_POST["description"]);
// rajouté pour test
$tmpName = $_FILES['file']['tmp_name'];
$name = $_FILES['file']['name'];
$size = $_FILES['file']['size'];
$error = $_FILES['file']['error'];
//  fin rajout test
require("bddconfig.php");


try{

    if(isset($_FILES['file']) && $messageDescription != "" && isset($iduser)){

        $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
    
        $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $PDOinsert = $objBdd->prepare("INSERT INTO `produits` ( `description`,`id`) VALUES ( :messageDescription, :iduser)" );
    
        $PDOinsert->bindParam(':pseudo' , $pseudo , PDO::PARAM_STR);
        $PDOinsert->bindParam(':messageLegend' , $messageDescription , PDO::PARAM_STR);
        $PDOinsert->bindParam(':iduser' , $iduser , PDO::PARAM_STR);
        
        $PDOinsert->execute();

        $idpost = $objBdd->lastInsertId();
     
    

        $tabExtension = explode('.', $name);
        $extension = strtolower(end($tabExtension));
        $extensions = ['jpg', 'png', 'jpeg', 'gif'];
        $maxSize = 4000000;

        
        if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
    
            $uniqueName = uniqid('', true);
            $file = $uniqueName.".".$extension;
            
            move_uploaded_file($tmpName, '../upload/'.$file);

              $PDOinsertFile = $objBdd->prepare("INSERT INTO `file` (`image`, `idpost`,`idcompte`) VALUES (:file , :idpost, :iduser)" );
              $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
   
              $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $PDOinsertFile->bindParam(':file' , $file , PDO::PARAM_STR);
              $PDOinsertFile->bindParam(':idpost' , $idpost , PDO::PARAM_STR);
              $PDOinsertFile->bindParam(':iduser' , $iduser , PDO::PARAM_STR);
    
            $PDOinsertFile->execute();
           
            
            header("Location: ../../index.php");

        

        }
    }

     
    //   if($messageLegend != ""  && $image!= "") {
    
    //     require('../bdd/bddconfig.php');
    
  
    //     $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
     
    //     $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //     $PDOlistlogins = $objBdd->prepare("SELECT * FROM post, file WHERE messageLegend = :messageLegend");
        
    //     $PDOlistlogins->bindParam(':messageLegend', $messageLegend, PDO::PARAM_STR);
       
    //     $PDOlistlogins->execute();
    
        
    //     $row_userweb = $PDOlistlogins->fetch();

    //     echo $row_userweb["mdp"];
    
        
    
    // }

       
    header('Location: ../php/profil_perso.php');

}catch( Exception $prmE){

    die("ERREUR : " . $prmE->getMessage());

}