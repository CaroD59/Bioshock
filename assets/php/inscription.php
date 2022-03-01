<?php


//  si 0 !=  l'utilisateur est connecter
if( $verif_co != 0){
    
    header("Location: index.php");
    
}

?>


<head>

    <link rel="stylesheet" href="assets/css/inscription.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>

<main>

    <?php
    if (!empty($_SESSION['message_app'])) {
        echo '<p class="message_app"> '.$_SESSION['message_app'].'</p>';
        unset($_SESSION['message_app']);
    }
    ?>

    <!-- BLOC BIENVENUE -->

    <div class="inscription">
        <h1 class="titre-inscription">Inscription</h1>
    <div>
        <img src="assets/img/Site/rapture.png" alt="" class="img__rapture">
    </div>
    </div>  

    <!-- FORM -->

    <div class="img-record">
        <img src="assets/img/Site/audio.png" alt="" class="audio-png">
        <p class="play-me">Jouez moi</p>
    <div class="audios">
        <img src="assets/img/Site/play.png" alt="" class="play-audio" id="play-audio">
        <img src="assets/img/Site/pause.png" alt="" class="play-audio" id="pause-audio">
        <audio src="assets/sons/beyond.mp3" id="audio"></audio>
    </div>
    </div>

    <form method="POST" action="assets/bdd/inscription_action.php" data-aos="zoom-in">

    <img src="assets/img/Site/lighthouse-rapture.png" alt="lighthouse" class="imgs-description">

        <div class="content-form">
            <div class="div-input">
                <label for="nom">Nom <span class="star-required">*</span></label>
            </div>
            <div class="div-input">
                <input type="text" class="input-connexion" name="nom" required>
            </div>
        </div>

        <div class="content-form">
            <div class="div-input">
                <label for="prenom">Prénom <span class="star-required">*</span></label>
            </div>
            <div class="div-input">
                <input type="text" class="input-connexion" name="prenom" required>
            </div>
        </div>

        
        <div class="content-form">
            <div class="div-input">
                <label for="email">Email <span class="star-required">*</span></label>
            </div>
            <div class="div-input">
                <input type="email" class="input-connexion" name="email" required>
            </div>
        </div>

        <div class="content-form">
            <div class="div-input">
                <label for="mdp">Mot de passe <span class="star-required">*</span></label>
            </div>
            <div class="div-input">
                <input type="password" class="input-connexion" name="mdp" required>
            </div>
        </div>

        <div class="content-form">
            <div class="div-input">
                <label for="mdp2">Confirmer mot de passe <span class="star-required">*</span></label>
            </div>
            <div class="div-input">
                <input type="password" class="input-connexion" name="mdp2" required>
            </div>
        </div>

        <input type="hidden" value="<?php echo $_SESSION["secure_id"]; ?>" name="token">
        <input type="hidden" value="<?php echo time() ?>" name="timestamp">

        <div class="content-form">
            <input type="submit" class="btn-submit" value="S'inscrire">
        </div>
        <div class="container-href">
            <a href="index.php?page=connexion" class="redirection">Se connecter</a>
        </div>
    </form>

</main>

<!-- BLOC TOP BUTTON  -->

<div class="btn-top">
            <img src="assets/img/Site/submarine.png" alt="sub" id="submarine-btn">
        </div>

</main>

</body>

<script src="assets/js/btn-top.js"></script>
<script src="assets/js/home-play-audio.js"></script>

<!-- AOS JS ANIMATION  -->

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>