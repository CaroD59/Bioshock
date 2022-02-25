
<head>
<link rel="stylesheet" href="assets/css/home.css">
</head>

<body>
    
<main>

<h1>HOME MEN</h1>

<section id="section1">

<?php
    if( $verif_co != 0 ){
?>
    <h1 class="bjr_prenom">Bonjour <span id="co_prenom"><?php echo  $_SESSION["logged_in"]["prenom"]; ?></span></h1>
            
<?php 
    }else if( $verif_co == 0){
?>

    <h1 class="bjr_prenom"><?php echo "Bonjour " ; ?></h1>

<?php 
}
?>  

<div id="barre"></div>

</section>



</main>






</body>