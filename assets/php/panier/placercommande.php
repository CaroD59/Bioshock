<!-- Cette page permet au client de savoir qu'il a passé une commande.
 Le client doit avoir des produits dans son panier après avoir cliqué 
 sur le bouton Passer la commande sur la page du panier.. -->
<head>
	<link rel="stylesheet" href="assets/css/commande.css">
</head>

<body>

	<main>
		<!-- BLOC BIENVENUE -->

		<div class="panier">
        	<h1 class="titre-panier">Commande confirmee</h1>
    		<div>
       		<img src="assets/img/Site/rapture.png" alt="" class="img__rapture">
    		</div>
			</div>

		<!-- ORDER -->

	<div class="placeorder">    
	<img src="assets/img/Site/lighthouse-rapture.png" alt="lighthouse" class="imgs-description">

		<!-- SI CONNECTE ON AFFICHE LE PRENOM -->
				<?php
    if( $verif_co != 0 ){
?>
    <p class="client">Cher(e) <span id="co_prenom"><?php echo  $_SESSION["logged_in"]["prenom"]; ?></span>,</p>
            
<?php 
    }else if( $verif_co == 0){
?>

		<!-- SINON -->
    <p class="client">Cher(e) <span id="co_prenom">client(e)</span>,</p>

<?php 
}
?>  
	  <p class="commande">Votre commande est prise en considération avec succès.</p>   
	  <p class="commande">Merci de faire vos achats au <span id="co_prenom">Jardin des Glaneuses</span> ! </p>   
	  <p class="commande">Nous vous contacterons par e-mail avec les détails de votre commande.</p>
		<p class="commande"><span id="co_prenom">Je vous pris</span> de passer une agréable journée.</p>
		<p class="ryan">- Andrew Ryan</p>
	</div>

		<!-- BOUTON RETURN -->

		<div class="return-div">
            <a href="index.php?page=home">
                <img src="assets/img/Site/return.png" alt="return" class="return">            
            </a>
      	</div>

	</main>

</body>
 

	  