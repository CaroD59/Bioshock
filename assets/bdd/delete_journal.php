
<?php
// on active les variables de session
session_start();

//si different de admin alors on renvoie vers la page connexion
if($_SESSION['logged_in']['type']  != "admin"){
    header("Location: ../../index.php?page=connexion");
}else{
  // On récupère l'idjournal et on va le convertir en chaine
  $idjournal = htmlspecialchars($_GET["id"]);

  require("bddconfig.php");

  try{
          //   connecte a la base mysql
      $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);
      // En cas de probléme renvoie dans le catch avec l'erreeur
      $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      die(var_dump($objBdd));

      $recup = $objBdd->query("DELETE FROM `journal` WHERE `idjournal` = $idjournal");

    
      //  Renvoie sur la page index.php
      header('Location: ../../index.php');
      

  }catch( Exception $prme){

  // Affiche le message d'erreur
    die("ERREUR : " . $prme->getMessage());
  }

}
?>
