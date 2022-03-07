<?php 
// on active les variables de session
session_start();

// recup le token
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
if($_SESSION["tentative_app"] > 20){
    // La variable de session message_app avec le message 
    $_SESSION["message_app"] = "Le formulaire est verrouiller ";
    // on redirige sur la page index.php
    header("Location: ../index.php?page=inscription" );
}

// recup des saisies POST de l'utilisateur
$nom = htmlspecialchars($_POST["nom"]);
$prenom = htmlspecialchars($_POST["prenom"]);
$email = htmlspecialchars(strtolower($_POST["email"]));
$password_clair =  htmlspecialchars(strval($_POST["mdp"]));
$confirm_password = htmlspecialchars(strval($_POST["mdp2"]));
$type = "user";


// on regarde si les variables ne sont pas vide
if( $nom != "" && $prenom != "" && $email != ""  && $password_clair != ""  && $confirm_password != "") {

    // on regarde si la saisie des mots de passe sont identiques
    if( $password_clair == $confirm_password){

        // on bcrypt le mot de passe de l'utilisateur 
        $hash_password = password_hash( $password_clair, PASSWORD_BCRYPT);

        require("../bdd/bddconfig.php");

        try {

            // Connecte a la base mysql
            $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
            // En cas de problème renvoie dans le catch avec l'erreur
            $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // ici on prepare notre requête SQL
            $PDOinsertuserweb = $objBdd->prepare("INSERT INTO  `users` (nom, prenom, email, mdp, type) VALUES (:nom, :prenom, :email, :password, :type)");
            // on initialise notre :nom avec la variable qui récup le nom
            $PDOinsertuserweb->bindParam(':nom', $nom, PDO::PARAM_STR);
            // on initialise notre :prenom avec la variable qui récup le prenom
            $PDOinsertuserweb->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            // on initialise notre :email avec la variable qui récup le email
            $PDOinsertuserweb->bindParam(':email', $email, PDO::PARAM_STR);
            // on initialise notre :password avec la variable qui récup le password
            $PDOinsertuserweb->bindParam(':password', $hash_password, PDO::PARAM_STR);
            // on execute la requête // on initialise notre :type avec la variable qui récup le type
            $PDOinsertuserweb->bindParam(':type', $type, PDO::PARAM_STR);
            // on execute la requête
            $PDOinsertuserweb->execute();

            // renvoie l'id du dernier utilisateur crée
            $lastId = $objBdd->lastInsertId();
            
           

            $_SESSION['tentative_app'] = 0;

            header("Location: ../../index.php?page=connexion");
    
        } catch (Exception $prmE) {
            die('Erreur : ' . $prmE->getMessage());
        }

    }

}else{
    header("Location: ../../index.php?page=inscription");
}