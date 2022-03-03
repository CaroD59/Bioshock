<?php

session_start();


$secure_id = $_POST["token"];
// on verifie le token de session avec celui du formulaire pour la validation
if($secure_id != $_SESSION["secure_id"]){
    // La variable de session message_app avec le message 
    $_SESSION["message_app"] = "Le formulaire n'est plus valide";
    // on redirige sur la page index.php
    header("Location: ../../index.php?page=inscription");

}

//on recup le timestamp
$timestamp = $_POST["timestamp"];
// on regarde si le timestamp - le timestamp du formulaire si il est > 900 (15min)
//Si true le formulaire a expiré  
if((time() - $timestamp) > 900 ){
    // La variable de session message_app avec le message 
    $_SESSION["message_app"] = "Le formulaire a expiré ";
    // on redirige sur la page index.php
    header("Location: ../../index.php?page=inscription" );

}
// on recup les tentative et on ajoute 1 
$_SESSION["tentative_app"] = intval($_SESSION["tentative_app"]) + 1 ;
// si le nombre et > 20 verouille le formulaire
if($_SESSION["tentative_app"] >= 20){
    // La variable de session message_app avec le message 
    $_SESSION["message_app"] = "Le formulaire est verrouiller ";
    // on redirige sur la page index.php
    header("Location: ../../index.php?page=inscription" );

}

// on recup la saisie de l'utilisateur en POST
$email = htmlspecialchars(strtolower($_POST["email"]));
$password_clair =  htmlspecialchars(strval($_POST["mdp"]));

try{

    // on va verifier si l'email et mot de passe ne sont pas vide
    if($email != ""  && $password_clair != "") {
    
        require('bddconfig.php');
    
        // Connecte a la base mysql
        $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
        // En cas de problème renvoie dans le catch avec l'erreur
        $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // ici on prepare notre requête SQL
        $PDOlistlogins = $objBdd->prepare("SELECT * FROM users WHERE email = :email ");
        // on initialise notre :email avec la variable qui récup le email
        $PDOlistlogins->bindParam(':email', $email, PDO::PARAM_STR);
        // execute la requête SQL
        $PDOlistlogins->execute();
    
        // on initialise une variable avec les données de utilisateur
        $row_userweb = $PDOlistlogins->fetch();
    
        if ($row_userweb != false) {
    
        // vérif du password :
            if (password_verify($password_clair, $row_userweb['mdp'])) {
                
                // authentification réussie
                // création de la variable de session : 
                // on stock les données utilisateur dans un tableau
                $session_data = array(
                    'iduser' => $row_userweb['iduser'],
                    'nom' => $row_userweb['nom'],
                    'prenom' => $row_userweb['prenom'],
                    'email' => $row_userweb['email'],
                    'type' => $row_userweb['type']
                );
    
                //régénérer le session id pour eviter d'avoir 2 user dans le $_SESSION
                session_regenerate_id();
                //enregistrer les données dans une variable de session
                $_SESSION['logged_in'] = $session_data;
                // $_SESSION['logged_in']["id"] = $row_userweb['idUser'];
                $PDOlistlogins->closeCursor();

                //reset les tentatives
                $_SESSION['tentative_app'] = 0;
    
                header("Location: ../../index.php");
               
    
            } else {

                  // La variable de session message_app avec le message 
                $_SESSION["message_app"] = "L'email ou mdp est incorrect ";
                // on redirige sur la page inscription
                header("Location: ../../index.php?page=connexion" );
                //Mauvais password
                // session_destroy();
                // die('Authentification incorrecte');
                
            }
    
        } else {

                 // La variable de session message_app avec le message 
                 $_SESSION["message_app"] = "L'email ou mdp est incorrect ";
                 // on redirige sur la page inscription
                 header("Location: ../../index.php?page=connexion" );
            //Mauvais login
            // session_destroy();
            // die('Authentification incorrecte');
        }
    
    } else {
        header("Location: ../../index.php?page=connexion");
    }
    

  }catch( Exception $prmE){

    die("Erreur" . $prmE->getMessage());


}