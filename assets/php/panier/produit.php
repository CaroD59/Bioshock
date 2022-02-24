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

	<div class="produit content-wrapper">
	    <img src="assets/img/Items/<?=$produit['img']?>" width="500" height="500" alt="<?=$produit['nom']?>">
	    <div>
	        <h1 class="name"><?=$produit['nom']?></h1>
	        <span class="price"> &euro;<?=$produit['prix']?>
	              <?php if ($produit['prix_Réel'] > 0): ?>
	             <span class="prix_Réel"> &euro;<?=$produit['prix_Réel']?></span>
	             <?php endif; ?>
	         </span>
	         <form action="index.php?page=panier/panier" method="post">
	             <input type="number" name="quantité" value="1" min="1" max="<?=$produit['quantité']?>" placeholder="Quantité" required>
	             <input type="hidden" name="produit_id" value="<?=$produit['id']?>">            <input type="submit" value="Ajouter au panier">
	         </form>
	         <div class="description">
	             <?=$produit['description']?>
	         </div>
	     </div></div>