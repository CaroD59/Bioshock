<head>
<link rel="stylesheet" href="assets/css/home.css">
</head>

<body>
    
<main>

<section id="section1">

<?php
    if( $verif_co != 0 ){
?>
    <h1 class ="titre"><span id="co_pseudo"><?php echo  $_SESSION["logged_in"]["pseudo"]; ?></span>, bienvenue a</h1>
    <div>
        <img src="assets/img/Site/rapture.png" alt="" class="img__rapture">
    </div>
            
<?php 
    }else if( $verif_co == 0){
?>

    <!-- <h1 class="bjr_pseudo"><?php echo "Bonjour " ; ?></h1> -->
    <h1 class ="titre">Bienvenue a</h1>
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