<?php

$titre = htmlspecialchars($_POST["titre"]);
$resume = htmlspecialchars($_POST["resume"]);
$idjournal = htmlspecialchars($_POST["idjournal"]);



// PHP lui donne un nom temporaire
$tmpName = $_FILES['file']['tmp_name'];
// le nom du fichier
$name = $_FILES['file']['name'];
// recup la taille de t'image
$size = $_FILES['file']['size'];
// on recup les erreurs si il y en a 
$error = $_FILES['file']['error'];

echo $tmpName;
echo "<br>";
echo $name;
echo "<br>";
echo $size;
echo "<br>";
echo $error;


try{

    if(isset($_FILES['file'])){

        // explode separe la chaine => ( image.jpg -> ["image", "jpg"] ) Agis comme un split(".") en js 
        $tabExtension = explode('.', $name);
        //strtolower met en minuscule tout une String
        $extension = strtolower(end($tabExtension));
        //Extensions des images qu'on accepte seulement
        $extensions = ['jpg', 'png', 'jpeg', 'gif'];
        //Va permettre la verification de la taille (ici c'est la taille a ne pas depasser)
        $maxSize = 10000000;
        
        //Verif si le fichier avec nos variables de verif au dessus
        if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){

            // recup les config bdd 
            require("bddconfig.php");
    
            //Avoir un nom unique par fichier
            $uniqueName = uniqid('', true);
            // on "creer" le nom du fichier 
            $file = $uniqueName.".".$extension;
            // Deplace le fichier vers notre dossier upload
            move_uploaded_file($tmpName, '../upload/'.$file);
            // Connecte a la base mysql
            $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
            // En cas de problème renvoie dans le catch avec l'erreur
            $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // ici on prepare notre requête SQL
            $PDOInsertFile = $objBdd->prepare("INSERT INTO `article` ( `titre`, `img`, `resume`, `idjournal` ) VALUES ( :titre , :img , :resume , :idjournal )");
            // on initialise notre :email avec la variable qui recup le email
            $PDOInsertFile->bindParam(':img', $file, PDO::PARAM_STR);
            $PDOInsertFile->bindParam(':titre', $titre, PDO::PARAM_STR);
            $PDOInsertFile->bindParam(':resume', $resume, PDO::PARAM_STR);
            $PDOInsertFile->bindParam(':idjournal', $idjournal, PDO::PARAM_STR);
            
          
            // execute la requête SQL
            $PDOInsertFile->execute();
            //Renvoie sur la page d'accueil
            header("Location: ../../index.php");

        }else{
            //Renvoie sur la page d'accueil
            header("Location: ../index.php");
        }

    }else{
        //Renvoie sur la page d'accueil
        header("Location: ../index.php");
    }

}catch(Exception $prmE){
    //Affiche un message d'erreur
    die('Erreur : '.$prmE->getMessage());
    
}
