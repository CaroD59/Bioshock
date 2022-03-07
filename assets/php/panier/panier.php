<?php 
require('assets/bdd/bddconfig.php');


	 /* Si l'utilisateur a cliqué sur le bouton "Ajouter au panier" sur la page du produit, nous pouvons vérifier les données du formulaire.*/   
	 if (isset($_POST['produit_id'], $_POST['quantite']) && is_numeric($_POST['produit_id']) && is_numeric($_POST['quantite'])) {   
	     /* Définissez les variables post afin que nous puissions les identifier facilement, assurez-vous également qu'elles sont entières.*/   
	     $produit_id = (int)$_POST['produit_id'];   
	     $quantite = (int)$_POST['quantite'];  

		 $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
		 // En cas de problème renvoie dans le catch avec l'erreur
		 $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	     /* Préparez l'instruction SQL, nous vérifions essentiellement si le produit existe dans notre base de données.*/   
	     $stmt = $objBdd->prepare('SELECT * FROM produits WHERE id = ?');   
	     $stmt->execute([$_POST['produit_id']]); 
		 
	     /* Récupère le produit depuis la base de données et renvoie le résultat sous forme de tableau.*/   
	     $produit = $stmt->fetch(PDO::FETCH_ASSOC);   
	     // Vérifier si le produit existe (le tableau n'est pas vide)   
	     if ($produit && $quantite > 0) {   
	         /*Le produit existe dans la base de données, maintenant nous pouvons créer/mettre à jour la variable de session pour le panier.*/   
	         if (isset($_SESSION['panier']) && is_array($_SESSION['panier'])) {   
	             if (array_key_exists($produit_id, $_SESSION['panier'])) {   
	                 // Le produit existe dans le panier, il suffit de mettre à jour la quantité.   
	                 $_SESSION['panier'][$produit_id] += $quantite;   
	             } else {   
	                 // Le produit n'est pas dans le panier, ajoutez-le   
	                 $_SESSION['panier'][$produit_id] = $quantite;   
	             }
	         } else {   
	             /* Il n'y a aucun produit dans le panier, ceci ajoutera le premier produit au panier.*/   
	             $_SESSION['panier'] = array($produit_id => $quantite);   
	         }
	     }   
	     // Empêcher la resoumission des formulaires...   
	     header('location: index.php?page=panier/panier');   
	     exit;
	 }
	


	 /* Retirez le produit du panier, vérifiez le paramètre "remove" de l'URL, c'est l'identifiant du produit, assurez-vous qu'il s'agit d'un numéro et vérifiez s'il est dans le panier.*/   
	 if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['panier']) && isset($_SESSION['panier'][$_GET['remove']])) {   
		// Remove the produit from the shopping panier   
		unset($_SESSION['panier'][$_GET['remove']]);   
	}
   
	 /* Mettre à jour les quantités de produits dans le panier si l'utilisateur clique sur le bouton "Mettre à jour" sur la page du panier d'achat*/   
	 if (isset($_POST['update']) && isset($_SESSION['panier'])) {   
		/* Boucle à travers les données postales afin de mettre à jour les quantités pour chaque produit du panier.*/   
		foreach ($_POST as $k => $v) {   
			if (strpos($k, 'quantite') !== false && is_numeric($v)) {   
				$id = str_replace('quantite-', '', $k);   
				$quantite = (int)$v;   
				// Effectuez toujours des contrôles et des validations   
				if (is_numeric($id) && isset($_SESSION['panier'][$id]) && $quantite > 0) {   
					// Mise à jour de la nouvelle quantité   
					$_SESSION['panier'][$id] = $quantite;   
				}
			}   
		}
		// Empêcher la re-soumission de formulaires...   
		header('location: index.php?page=panier/panier');   
		exit;
	}

	/* Diriger l'utilisateur vers la page de commande s'il clique sur le bouton Passer la commande, le panier ne doit pas être vide.*/   
	if (isset($_POST['placercommande']) && isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {   
		header('Location: index.php?page=panier/placercommande');   
		exit;
	}

	 /* Vérification de la variable de session pour les produits en panier*/   
	 $produits_in_panier = isset($_SESSION['panier']) ? $_SESSION['panier'] : array();   
	 $produits = array();   
	 $subtotal = 0.00;   
	 // S'il y a des produits dans le panier   
	 if ($produits_in_panier) {   
	     /* Il y a des produits dans le panier, nous devons donc sélectionner ces produits dans la base de données.*/   
	     /* Mettre les produits du panier dans un tableau de chaîne de caractères avec point d'interrogation, nous avons besoin que l'instruction SQL inclue  ( ?,?, ?,...etc).*/   
	     $array_to_question_marks = implode(',', array_fill(0, count($produits_in_panier), '?'));   

		 $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
		 // En cas de problème renvoie dans le catch avec l'erreur
		 $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

	     $stmt = $objBdd->prepare('SELECT * FROM produits WHERE id IN (' . $array_to_question_marks . ')');   
	     /* Nous avons uniquement besoin des clés du tableau, pas des valeurs, les clés sont les identifiants des produits. */   
	     $stmt->execute(array_keys($produits_in_panier));   
	     /* Récupérer les produits de la base de données et retourner le résultat sous la forme d'un tableau.*/   
	     $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);   
	     // Calculez le total partiel   
	     foreach ($produits as $produit) {   
	         $subtotal += (float)$produit['prix'] * (int)$produits_in_panier[$produit['id']];   
	     }
	 }  
	 ?>

	 <head>
		 <link rel="stylesheet" href="assets/css/panier.css">
		 <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	 </head>

<body>
		 
	 	<main>

<!-- BLOC BIENVENUE -->

			<div class="panier">
        	<h1 class="titre-panier">Votre panier d'achat</h1>
    		<div>
       		<img src="assets/img/Site/rapture.png" alt="" class="img__rapture">
    		</div>
			</div>  

<div class="Bloc-Panier">   

<!-- FORM PANIER -->

	      <form action="index.php?page=panier/panier" method="post">   
				 <img src="assets/img/Site/lighthouse-rapture.png" alt="lighthouse" class="imgs-description">
	 					<!-- SI PANIER VIDE -->
	                  <?php if (empty($produits)): ?>     
	                      <p class="panier-vide">Vous n'avez aucun produit ajoute dans votre panier</p>   
						<!-- SI PANIER PAS VIDE AFFICHE MOI LES PRODUITS -->
	                  <?php else: ?>   
	                  <?php foreach ($produits as $produit): ?>   
						<!-- IMAGE DU PRODUIT -->
						<div class="product">
	                  <div class="img-panier">
	                      <a href="index.php?page=panier/produit&id=<?=$produit['id']?>">   
	                          <img src="assets/upload/<?=$produit['img']?>" alt="<?=$produit['nom']?>" class="img">   
	                      </a>  
										</div> 
						<!-- NOM DU PRODUIT -->
	       						<div class="name">
					 							<a href="index.php?page=panier/produit&id=<?=$produit['id']?>"><?=$produit['nom']?></a>
										</div>
						<!-- PRIX DU PRODUIT -->
	                      <p class="prix-produit">&euro;<?=$produit['prix']?></p>  
						<!-- BOUTON POUBELLE -->
										<div class="poubelle">
	                    	<a href="index.php?page=panier/panier&remove=<?=$produit['id']?>" class="remove"><i class="fas fa-trash">&nbsp;</i><img src="assets/img/Boutique/delete.png" alt="delete" class="delete"></a>
										</div>
										<div class="quantite-prix">
											<div>
							<!-- BOUTON QUANTITE  -->
	                      <input type="number" name="quantite-<?=$produit['id']?>" value="<?=$produits_in_panier[$produit['id']]?>" min="1" max="<?=$produit['quantite']?>" placeholder="quantité" class="quantite" required>												
											</div>
											<div>
						<!-- PRIX   -->
	    									<p class="prix-produit-total">&euro;<?=$produit['prix']*$produits_in_panier[$produit['id']]?></p>												
											</div>
						</div> 
						</div>
	                  <?php endforeach; ?>   
	                  <?php endif; ?>

<!-- SUBTOTAL -->

										<div class="subtotal">
											<div>
												<span class="text">Subtotal</span>   												
											</div>   
											<div class="div-prix-sub">
												<span class="prix-sub">&euro;<?=$subtotal?></span> 												
											</div>
  
										</div>  


<!-- BOUTONS SUBMIT -->
										<div class="buttons">   
											<input type="submit" value="Mettre à jour" name="update" class='btn-submit' >   
											<input type="submit" value="Passer la commande" name="placercommande" class='btn-submit'>
										</div>  

	      </form> 


<!-- BOUTON RETURN -->

				<div class="return-div">
            <a href="index.php?page=panier/produits">
                <img src="assets/img/Site/return.png" alt="return" class="return">            
            </a>
      	</div>

</div>

<!-- BLOC TOP BUTTON  -->

<div class="btn-top">
    <img src="assets/img/Site/submarine.png" alt="sub" id="submarine-btn">
</div>

		</main>

</body>

<script src="assets/js/btn-top.js"></script>

<!-- AOS JS ANIMATION  -->

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>




