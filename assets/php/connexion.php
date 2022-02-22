<?php

//  si 0 !=  l'utilisateur est connecter
if( $verif_co != 0){
    
    header("Location: index.php");
    
}

?>


<head>
    <link rel="stylesheet" href="css/connexion.css">
</head>

<main>

    <form method="POST" action="bdd/connexion_action.php">

        <h3>Connexion</h3>

        <div class="content-form">
            <label for="email">Email *</label>
            <input type="email" name="email" required>
        </div>

        <div class="content-form">
            <label for="mdp">Mot de passe *</label>
            <input type="password" name="mdp" required>
        </div>

        <input type="hidden" value="<?php echo $_SESSION["secure_id"]; ?>" name="token">
        <input type="hidden" value="<?php echo time() ?>" name="timestamp">

        <div class="content-form">
            <input type="submit">
        </div>
        <div class="container-href">
        <a href="index.php?page=inscription" class="redirection">S'inscire</a>

    </form>

</main>