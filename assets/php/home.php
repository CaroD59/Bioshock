<head>
<link rel="stylesheet" href="assets/css/home.css">
</head>

<body>
    
<main>

<section id="section1">

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
   
    

<?php 
}
?>  

<div>
    <h2>Qu'est-ce que Rapture ?</h2>
</div>

</section>

</main>

</body>