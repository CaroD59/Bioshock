
<head>
  <link rel="stylesheet" href="assets/css/update-profil-design.css">  
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
    
<main>
<?php
           if( $verif_co == 0 ){

            header("Location: index.php?page=connexion");
           }
           ?>

    
    <!-- BLOC BIENVENUE -->

    <div class="update">
        <h1 class="titre-update">Modification du profil</h1>
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
        <audio src="assets/sons/sweet.mp3" id="audio"></audio>
    </div>
    </div>

    <div class="container_profil" data-aos="zoom-in">

<form method="POST" id="form" action="assets/bdd/profil_update_action.php">

<img src="assets/img/Site/lighthouse-rapture.png" alt="lighthouse" class="imgs-description">

    <div class="profil">
    <input placeholder="Nom" type="text" name="nom" class="input-connexion" required>
    </div>

    <div class="profil">
    <input placeholder="Prénom" type="text" name="prenom" class="input-connexion" required>
    </div>

    <div class="profil">
    <input placeholder="Email" type="text" name="email" class="input-connexion" required>
    </div>

    <div class="profil">
    <input placeholder="Mot de Passe" type="password" name="mdp" class="input-connexion" required>
    </div>

    <div class="profil">
    <input placeholder="Confirmer le Mot de Passe" type="password" name="mdp2" class="input-connexion" required>
    </div>


   
    <div class="profil1">
    <input id="envoyer" type="submit" value="Enregistrer ">
    </div>
    
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

</html>