<?php 
require('assets/bdd/bddconfig.php');


	 /* Si l'utilisateur a cliqué sur le bouton "Ajouter au panier" sur la page du produit, nous pouvons vérifier les données du formulaire.*/   
	 if (isset($_POST['produit_id'], $_POST['quantité']) && is_numeric($_POST['produit_id']) && is_numeric($_POST['quantité'])) {   
	     /* Définissez les variables post afin que nous puissions les identifier facilement, assurez-vous également qu'elles sont entières.*/   
	     $produit_id = (int)$_POST['produit_id'];   
	     $quantité = (int)$_POST['quantité'];  

		 $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
		 // En cas de problème renvoie dans le catch avec l'erreur
		 $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	     /* Préparez l'instruction SQL, nous vérifions essentiellement si le produit existe dans notre base de données.*/   
	     $stmt = $objBdd->prepare('SELECT * FROM produits WHERE id = ?');   
	     $stmt->execute([$_POST['produit_id']]); 
		 
	     /* Récupère le produit depuis la base de données et renvoie le résultat sous forme de tableau.*/   
	     $produit = $stmt->fetch(PDO::FETCH_ASSOC);   
	     // Vérifier si le produit existe (le tableau n'est pas vide)   
	     if ($produit && $quantité > 0) {   
	         /*Le produit existe dans la base de données, maintenant nous pouvons créer/mettre à jour la variable de session pour le panier.*/   
	         if (isset($_SESSION['panier']) && is_array($_SESSION['panier'])) {   
	             if (array_key_exists($produit_id, $_SESSION['panier'])) {   
	                 // Le produit existe dans le panier, il suffit de mettre à jour la quantité.   
	                 $_SESSION['panier'][$produit_id] += $quantité;   
	             } else {   
	                 // Le produit n'est pas dans le panier, ajoutez-le   
	                 $_SESSION['panier'][$produit_id] = $quantité;   
	             }
	         } else {   
	             /* Il n'y a aucun produit dans le panier, ceci ajoutera le premier produit au panier.*/   
	             $_SESSION['panier'] = array($produit_id => $quantité);   
	         }
	     }   
	     // Empêcher la resoumission des formulaires...   
	     header('location: index.php?page=panier');   
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
			if (strpos($k, 'quantité') !== false && is_numeric($v)) {   
				$id = str_replace('quantité-', '', $k);   
				$quantité = (int)$v;   
				// Effectuez toujours des contrôles et des validations   
				if (is_numeric($id) && isset($_SESSION['panier'][$id]) && $quantité > 0) {   
					// Mise à jour de la nouvelle quantité   
					$_SESSION['panier'][$id] = $quantité;   
				}
			}   
		}
		// Empêcher la re-soumission de formulaires...   
		header('location: index.php?page=panier');   
		exit;
	}

	/* Diriger l'utilisateur vers la page de commande s'il clique sur le bouton Passer la commande, le panier ne doit pas être vide.*/   
	if (isset($_POST['placercommande']) && isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {   
		header('Location: index.php?page=placercommande');   
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



	   <div class="panier content-wrapper">   
	       <h1>Panier d'achat</h1>   
	       <form action="index.php?page=panier" method="post">   
	           <table>  
	              <thead>   
	                  <tr>   
	                      <td colspan="2">produit</td>   
	                      <td>prix</td>   
	                      <td>quantité</td>   
	                      <td>Total</td>   
	                  </tr>   
	              </thead>   
	              <tbody>   
	                  <?php if (empty($produits)): ?>   
	                  <tr>   
	                      <td colspan="5" style="text-align:center;">Vous n'avez aucun produit ajouté dans votre panier</td>   
	                  </tr>   
	                  <?php else: ?>   
	                  <?php foreach ($produits as $produit): ?>   
	                  <tr>   
	                      <td class="img">   
	                          <a href="index.php?page=produit&id=<?=$produit['id']?>">   
	                              <img src="assets/img/Items/<?=$produit['img']?>" width="50" height="50" alt="<?=$produit['nom']?>">   
	                          </a>
	                      </td>   
	       <td><a href="index.php?page=produit&id=<?=$produit['id']?>"><?=$produit['nom']?></a>   
	                          <br>   
	                          <a href="index.php?page=panier&remove=<?=$produit['id']?>" class="remove"><i class="fas fa-trash">&nbsp;</i>Supprimer </a></td>   
	                      <td class="prix">&euro;<?=$produit['prix']?></td>   
	                      <td class="quantité"><input type="number" name="quantité-<?=$produit['id']?>" value="<?=$produits_in_panier[$produit['id']]?>" min="1" max="<?=$produit['quantité']?>" placeholder="quantité" required></td>   
	    <td class="prix">&euro;<?=$produit['prix']*$produits_in_panier[$produit['id']]?></td>   
	                  </tr>   
	                  <?php endforeach; ?>   
	                  <?php endif; ?>   
	              </tbody>   
	          </table>  
	          <div class="subtotal">   
	              <span class="text">Subtotal</span>   
	              <span class="prix">&euro;<?=$subtotal?></span>   
	          </div>  
	            <div class="buttons">   
	              <input type="submit" value="Mettre à jour" name="update">   
	              <input type="submit" value="Passer la commande" name="placercommande">
				</div>  
	      </form>   
	  </div>