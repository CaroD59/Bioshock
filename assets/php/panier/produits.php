<?php 
	/* Determiner le nombre de produits à afficher sur chaque page*/
	$nbr_produits_sur_chaque_page = 2;
	/* La page actuelle, apparaîtra dans l'URL  comme index.php?page=produits&p=1 ou p=2 ce signifié la page 1 l& page 2 etc...*/
	$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;

    require('assets/bdd/bddconfig.php');

     // Connecte a la base mysql
     $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
     // En cas de problème renvoie dans le catch avec l'erreur
     $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	/* Sélectionnez les produits commandés par la date ajoutée*/
	$stmt = $objBdd->prepare('SELECT * FROM produits ORDER BY date_ajou DESC LIMIT ?,?');
	/* bindValue nous permettra d'utiliser des entiers dans la déclaration SQL, que nous devons utiliser pour LIMIT.*/
	$stmt->bindValue(1, ($current_page - 1) * $nbr_produits_sur_chaque_page, PDO::PARAM_INT);
	$stmt->bindValue(2, $nbr_produits_sur_chaque_page, PDO::PARAM_INT);
	$stmt->execute();
	/* récupérer les produits de la base de données et retourner le résultat sous la forme d'un tableau.*/
	$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Obtenir le nombre total de produits
	$total_produits = $objBdd->query('SELECT * FROM produits')->rowCount();
	?>

	<div class="produits content-wrapper">
	    <h1>produits</h1>
		<!-- si admin alors on vera le bouton créer -->
		<?php
		if($type == "admin"){
		?>
			<a href="index.php?page=create_produit" class="post"> Créer un produits</a>
			
		<?php
		}
		?>
		
	    <p><?=$total_produits?> produits</p>
	    <div class="produits-wrapper"><table><tr>
			<!-- foreach  est utilisée pour parcourir les éléments d'un tableau indexé ou associatif. -->
	        <?php foreach ($produits as $produit): ?>
	        <td><a href="index.php?page=panier/produit&id=<?=$produit['id']?>" class="produit"> <img src="assets/upload/<?=$produit['img']?>" width="200" height="200" alt="<?=$produit['nom']?>"><br>
	            <span class="nom"><?=$produit['nom']?></span><br>
	            <span class="price">
	                &euro;<?=$produit['prix']?>
	                <?php if ($produit['prix_Reel'] > 0): ?>  
	               <span class="prix_Reel">&euro;<?=$produit['prix_Reel']?></span>
	                <?php endif; ?>
	            </span>
	        </a></td>
	        <?php endforeach; ?>
	               </tr></table>
	    </div>
	    <div class="buttons">
	        <?php if ($current_page > 1): ?>
	        <a href="index.php?page=panier/produits&p=<?=$current_page-1?>"><i class="fas fa-angle-double-left"> </i> Prev</a>
	        <?php endif; ?>
	        <?php if ($total_produits > ($current_page * $nbr_produits_sur_chaque_page) - $nbr_produits_sur_chaque_page + count($produits)): ?>
	        <a href="index.php?page=panier/produits&p=<?=$current_page+1?>">Next <i class="fas fa-angle-double-right"> </i></a>
	        <?php endif; ?>
	    </div>
	</div>
