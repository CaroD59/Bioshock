<head>
<link rel="stylesheet" href="assets/css/home.css">
</head>

<body>
    
<main>

<section id="section1">

<div class="welcome">
<?php
    if( $verif_co != 0 ){
?>
    <h1 class ="bjr_prenom"><span id="co_prenom"><?php echo  $_SESSION["logged_in"]["prenom"]; ?></span>, bienvenue a</h1>
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
</div>   
    

<?php 
}
?>  

<div class="Ryan-Bloc">
    <h2>Qui est Andrew Ryan ?</h2>
    <div class="Ryan">
        <div class="img-ryan">
        <img src="assets/img/Site/ryan.jpg" alt="" class="ryan-img">
    </div>
        <div class="img-record">
        <img src="assets/img/Site/audio.png" alt="" class="audio-png">
        <img src="assets/img/Site/play.png" alt="" class="play-audio">
    </div>
        <div class="description">text</div>
    </div>
</div>

</section>

</main>

</body>