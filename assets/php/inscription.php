<?php


//  si 0 !=  l'utilisateur est connecter
if( $verif_co != 0){
    
    header("Location: index.php");
    
}

?>


<head>

    <link rel="stylesheet" href="css/inscription.css">

</head>

<main>

    <?php
    if (!empty($_SESSION['message_app'])) {
        echo '<p class="message_app"> '.$_SESSION['message_app'].'</p>';
        unset($_SESSION['message_app']);
    }
    ?>

    <form method="POST" action="bdd/inscription_action.php">

        <h3>INSCRIPTION</h3>

        <div class="content-form">
            <label for="nom">Nom *</label>
            <input type="text" name="nom" required>
        </div>

        <div class="content-form">
            <label for="prenom">Prenom *</label>
            <input type="text" name="prenom" required>
        </div>

        <div class="content-form">
            <label for="email">Email *</label>
            <input type="email" name="email" required>
        </div>

        <div class="content-form">
            <label for="mdp">Mot de passe *</label>
            <input type="password" name="mdp" required>
        </div>

        <div class="content-form">
            <label for="mdp2">Confirmer mot de passe *</label>
            <input type="password" name="mdp2" required>
        </div>

        <input type="hidden" value="<?php echo $_SESSION["secure_id"]; ?>" name="token">
        <input type="hidden" value="<?php echo time() ?>" name="timestamp">

        <div class="content-form">
            <input type="submit" value="ENVOYER">
        </div>
        <div class="container-href">
        <a href="index.php?page=connexion" class="redirection">Se Connecter</a>

    </form>


</main>