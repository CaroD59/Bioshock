<head>
<link rel="stylesheet" href="assets/css/home.css">
</head>

<body>
    
<main>

<section id="section1">

<!-- BLOC BIENVENUE -->

<div class="welcome">
<?php
    if( $verif_co != 0 ){
?>
    <h1 class ="bjr_prenom"><span id="co_prenom"><?php echo  $_SESSION["logged_in"]["prenom"]; ?></span>,</h1>
    <h1 class ="bjr_prenom">bienvenue a</h1>
    <div>
        <img src="assets/img/Site/rapture.png" alt="" class="img__rapture">
    </div>
            
<?php 
    }else if( $verif_co == 0){
?>

    <!-- <h1 class="bjr_pseudo"><?php echo "Bonjour " ; ?></h1> -->
    <h1 class ="bjr_prenom">Bienvenue a</h1>
    <div>
        <img src="assets/img/Site/rapture.png" alt="" class="img__rapture">
    </div>

<?php 
}
?>  
</div>  

<!-- BLOC CARROUSEL -->

<!-- BLOC DESCRIPTION SITE -->

<div>
    <h2>Qu'est-ce donc <span class="andrew-ryan">Rapture</span> ?</h2>
</div>

<div class="Description-Bloc">
 <div class="text">
    <p>
         Description
    </p>
 </div>
 <div class="img1">
    <img src="assets/img/Site/rapture-description.jpg" alt="" class="imgs-description">
 </div>
</div>

<!-- BLOC ANDREW RYAN -->

<div>
    <h2>Qui est <span class="andrew-ryan">Andrew Ryan</span> ?</h2>
</div>

<div class="Ryan-Bloc">
    <div class="Ryan">
    <div class="img-ryan">
        <img src="assets/img/Site/ryan.jpg" alt="" class="ryan-img">
    </div>
    <div class="img-record">
        <img src="assets/img/Site/audio.png" alt="" class="audio-png">
        <p class="play-me">Jouez moi</p>
    <div class="audios">
        <img src="assets/img/Site/play.png" alt="" class="play-audio" id="play-audio">
        <img src="assets/img/Site/pause.png" alt="" class="play-audio" id="pause-audio">
        <audio src="assets/sons/ryan-speech.mp3" id="audio"></audio>
    </div>
    </div>
    </div>
    <div class="description">
            <p>Hey</p>
    </div>
</div>

<!-- BLOC ACCES -->
<div>
    <h2>Plan d'acces a <span class="andrew-ryan">Rapture</span></h2>
</div>

<div class="Bloc-Accès">
    <div class="bloc-img-map"><img src="assets/img/Site/map.jpg" alt="" class="img-map"></div>
    <div><p class="text">Plan d'accès</p></div>
</div>


<!-- BLOC ENSEIGNES -->
<div>
    <h2>Enseignes a <span class="andrew-ryan">Rapture</span></h2>
</div>
<div class="Bloc-Enseignes">
    <div class="enseignes">
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/arcadia.png" alt="" class="enseigne-flick">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/bains-adonis.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/dionysus-park.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/farmer-s-market.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/fontaine.png" alt="" class="enseigne-flick1">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/fort-frolic.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/hephaestus.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/kashmir-restaurant.png" alt="" class="enseigne-flick">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/lighthouse.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/mercury-suites.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/neptune-s-bounty.png" alt="" class="enseigne-flick1">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/pauper-s-drop.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/pavillon-medical.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/ryan-amusement.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/siren-alley.png" alt="" class="enseigne">
        </div>
    </div>
</div>

</section>

</main>

</body>

<script src="assets/js/home-play-audio.js"></script>