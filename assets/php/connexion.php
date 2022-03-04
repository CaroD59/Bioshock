<?php

//  si 0 !=  l'utilisateur est connecter
if( $verif_co != 0){
    
    header("Location: index.php");
    
}

?>

<head>
    <link rel="stylesheet" href="assets/css/connexion.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>

<main>



<!-- BLOC BIENVENUE -->

<div class="connexion">
        <h1 class="titre-connexion">Connexion</h1>
    <div>
        <img src="assets/img/Site/rapture.png" alt="" class="img__rapture">
    </div>
</div>  

<!-- BLOC SISTER -->

<div>
    <img src="assets/img/Site/Sister.jpg" alt="sister" class="sister" id='sister'>
</div>

<!-- FORM -->

<div class="img-record">
        <img src="assets/img/Site/audio.png" alt="" class="audio-png">
        <p class="play-me">Jouez moi</p>
    <div class="audios">
        <img src="assets/img/Site/play.png" alt="" class="play-audio" id="play-audio">
        <img src="assets/img/Site/pause.png" alt="" class="play-audio" id="pause-audio">
        <audio src="assets/sons/ocean.mp3" id="audio"></audio>
    </div>
    </div>
  
    

    <form method="POST" action="assets/bdd/connexion_action.php" data-aos="zoom-in">
   

    <img src="assets/img/Site/lighthouse-rapture.png" alt="lighthouse" class="imgs-description">
    <?php
    if (!empty($_SESSION['message_app'])) {
        echo '<p class="message_app"> '.$_SESSION['message_app'].'</p>';
        unset($_SESSION['message_app']);
    }
    ?>

        <div class="content-form">
            <div class="div-input">
                <label for="email" class="input-form">Email <span class="star-required">*</span></label>
            </div>
            <div class="div-input">
                <input type="email" class="input-connexion" name="email" placeholder="Email" required>
            </div>
        </div>

        <div class="content-form">
            <div class="div-input">
                <label for="mdp" class="input-form">Mot de passe <span class="star-required">*</span></label>
            </div>
            <div class="div-input">
                <input type="password" class="input-connexion" name="mdp" placeholder="Password" required>     
            </div>
        </div>

            <input type="hidden" value="<?php echo $_SESSION["secure_id"]; ?>" name="token">
            <input type="hidden" value="<?php echo time() ?>" name="timestamp">

        <div class="content-form">
            <input type="submit" class="btn-submit" value="Se connecter">
        </div>

        <div class="container-href">
            <a href="index.php?page=inscription" class="redirection">S'inscrire</a>
        </div>
    </form>

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