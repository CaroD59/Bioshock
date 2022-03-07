<?php  

require('assets/bdd/bddconfig.php');

    
	 // Vérifiez si le paramètre id est spécifié dans l'URL.  
	 if (isset($_GET['id'])) {
		    // Connecte a la base mysql
     $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
     // En cas de problème renvoie dans le catch avec l'erreur
     $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	     // Pour éviter toute injection SQL, préparez l'instruction et exécutez-la.  
	     $stmt = $objBdd->prepare('SELECT * FROM produits WHERE id = ?');  
	     $stmt->execute([$_GET['id']]);  
	     /*  Récupérer le produit de la base de données et retourner le résultat sous forme de tableau.*/  
	     $produit = $stmt->fetch(PDO::FETCH_ASSOC);  
	     /* Vérifiez si le produit existe (le tableau n'est pas vide)*/  
	     if (!$produit) {  
	         /*Erreur simple à afficher si l'id du produit n'existe pas (le tableau est vide)*/  
	         exit('le produit n\'existe pas!');  
	     }
	 } else {  
	     //  Erreur simple à afficher si l'id n'a pas été spécifié.  
	     exit('le produit n\'existe pas!');  
	 }
	 ?>

	<head>

				<link rel="stylesheet" href="assets/css/produit.css">
				<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

	</head>

<body>

		<main>

<!-- BLOC BIENVENUE -->

<div class="shop">
		<h1 class="titre-shop">Au Jardin des Glaneuses</h1>
<div>
		<img src="assets/img/Site/rapture.png" alt="" class="img__rapture">
</div>
</div> 

<!-- BLOC PAGE -->

<img src="assets/img/Boutique/jardin-logo.png" alt="jardin" class="jardin">


			<div class="produit">
	    			<img src="assets/upload/<?=$produit['img']?>" alt="<?=$produit['nom']?>" class="img-produit">

	    	<div class="product">

	 				<div class="description-bloc">
	        	<h1 class="name"><?=$produit['nom']?></h1>
						<p class="text-description">
	          <?=$produit['description']?>									
						</p>
							 
					 </div>

	 				<div class="prix-bloc">
	        	<span class="price"> &euro;<?=$produit['prix']?> au lieu de 
	              <?php if ($produit['prix_Reel'] > 0): ?>
	             <span class="prix_Reel"> &euro;<?=$produit['prix_Reel']?></span>
	             <?php endif; ?>
	         </span>
	         <form action="index.php?page=panier/panier" method="post">
						 	<div>
	            	<input type="number" name="quantite" class="quantite" value="1" min="1" max="<?=$produit['quantite']?>" placeholder="Quantité" required>							 
						 	</div>
							<div>
	             <input type="hidden" name="produit_id" value="<?=$produit['id']?>"> <input type="submit" value="Ajouter au panier"  class="btn-submit">								
							</div>
	         </form>						 
					 </div>

	      </div>

			</div>

<!-- BOUTON RETURN -->

			 <div class="return-div">
            <a href="index.php?page=panier/produits">
                <img src="assets/img/Site/return.png" alt="return" class="return">            
            </a>
      </div>

		</main>

</body>