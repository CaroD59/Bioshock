
<head>

<!-- link ici -->
</head>

<body>
    
<main>

<h1>HOME MEN</h1>

<section id="section1">

<?php
    if( $verif_co != 0 ){
?>
    <h1 class="bjr_pseudo">Bonjour <span id="co_pseudo"><?php echo  $_SESSION["logged_in"]["pseudo"]; ?></span></h1>
            
<?php 
    }else if( $verif_co == 0){
?>

    <h1 class="bjr_pseudo"><?php echo "Bonjour " ; ?></h1>

<?php 
}
?>  

<div id="barre"></div>

</section>



</main>






</body>