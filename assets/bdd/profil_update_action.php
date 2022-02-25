<?php

session_start();


$secure_id = $_POST["token"];
// on verifie le token de session avec celui du formulaire pour la validation
if($secure_id != $_SESSION["secure_id"]){
    // La variable de session message_app avec le message 
    $_SESSION["message_app"] = "Le formulaire n'est plus valide";
    // on redirige sur la page index.php
    header("Location: ../index.php?page=inscription");

}

//on recup le timestamp
$timestamp = $_POST["timestamp"];
// on regarde si le timestamp - le timestamp du formulaire si il est > 900 (15min)
//Si true le formulaire a expiré  
if((time() - $timestamp) > 900 ){
    // La variable de session message_app avec le message 
    $_SESSION["message_app"] = "Le formulaire a expiré ";
    // on redirige sur la page index.php
    header("Location: ../index.php?page=inscription" );

}
// on recup les tentative et on ajoute 1 
$_SESSION["tentative_app"] = intval($_SESSION["tentative_app"]) + 1 ;
// si le nombre et > 20 verouille le formulaire
if($_SESSION["tentative_app"] <= 20){
    // La variable de session message_app avec le message 
    $_SESSION["message_app"] = "Le formulaire est verrouiller ";
    // on redirige sur la page index.php
    header("Location: ../index.php?page=inscription" );

}





$id = htmlspecialchars($_SESSION["logged_in"]["iduser"]);
$email = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST["mdp"]);
$cpassword = htmlspecialchars($_POST["mdp2"]);
$prenom = htmlspecialchars($_POST["prenom"]);
$nom = htmlspecialchars($_POST["nom"]);



try {

    require("../bdd/bddconfig.php");

    // Connexion à la base mysql
    $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);

    // En cas de problème renvoie dans le catch avec l'erreur
    $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // on regarde si la saisie des mots de passe sont vides pour l'update
    if ($password == "" && $cpassword == "") {

        // on met les variables de SESSION avec les nouvelles valeurs (values)



        $_SESSION["logged_in"]["email"] = $email;

        // La requête qui va mettre à jour nos modif
        $recup = $objBdd->prepare("UPDATE `users` SET  `email` = :email,`prenom` = :prenom,`nom` = :nom   WHERE iduser = $id");


        
        // on initialise notre :email avec la variable qui récup le email
        $recup->bindParam(':email', $email, PDO::PARAM_STR);
        // execute la requête SQL
        $recup->bindParam(':nom', $nom, PDO::PARAM_STR);
        $recup->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $recup->execute();
    } else {

        // on regarde si la saisie des mots de passe est identique
        if ($password == $cpassword) {

            // on met les variables de SESSION avec les nouvelles valeurs (values)
            $_SESSION["logged_in"]["email"] = $email;
            $_SESSION["logged_in"]["prenom"] = $prenom;
            $_SESSION["logged_in"]["nom"] = $nom;


            // on bcrypt le mot de passe
            $password = password_hash($password, PASSWORD_BCRYPT);

            // La requête qui va mettre à jour nos modif
            $recup = $objBdd->prepare("UPDATE `users` SET  `email` = :email , `mdp` = :mdp,`prenom` = :prenom ,`nom` = :nom  WHERE iduser = $id");

          
            // on initialise notre :email avec la variable qui récup le email
            $recup->bindParam(':email', $email, PDO::PARAM_STR);
            // on initialise notre :mdp avec la variable qui récup le mdp
            $recup->bindParam(':mdp', $password, PDO::PARAM_STR);

            $recup->bindParam(':prenom', $prenom, PDO::PARAM_STR);

            $recup->bindParam(':nom', $nom, PDO::PARAM_STR);
            // execute la requête SQL
            $recup->execute();
        }
    }
} catch (Exception $prmE) {
    die("Erreur : " . $prmE->getMessage());
}



header("Location: ../../index.php?page=home");
