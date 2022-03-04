<?php 
	/* Determiner le nombre de produits à afficher sur chaque page*/
	$nbr_produits_sur_chaque_page = 100;
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


<!-- PAGE -->

<head>

    <link rel="stylesheet" href="assets/css/boutique.css">
		<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>
	
	<main>

<!-- BLOC BIENVENUE -->

		<div class="shop">
        <h1 class="titre-shop">Boutique de Rapture</h1>
    <div>
        <img src="assets/img/Site/rapture.png" alt="" class="img__rapture">
    </div>
    </div> 

			<div class="bloc-produits">

<!-- SI ADMIN = BOUTON CREER PRODUIT -->

		<?php
		if($type == "admin"){
		?>
		<div class="create-for-ryan">
			<a href="index.php?page=create_produit" class="post">
			<img src="assets/img/Boutique/plus.png" alt="plus" class="plus">
				Creer un produit
			</a>
		</div>

		<?php
		}
		?>


	    <p class="produits-dispos">
				<span class="number-produits"><?=$total_produits?></span> produits disponibles actuellement à la boutique
			</p>

<!-- PRESENTATION -->

	<div class="presentation" data-aos="flip-up">

			<img src="assets/img/Site/lighthouse-rapture.png" alt="lighthouse" class="imgs-description">

			<p class="titre-description">
				Bienvenue à la boutique de <span class="span-ryan">Rapture</span> !
			</p>
			<p class="text-description">
				Vous y trouverez une multitude d'objets qui feront votre bonheur. Plasmide, <span class="span-ryan">Adam</span>, Eve, et bien d'autres encore... en coopération avec la ville de Columbia, nous avons également reçu une petite réserve de <span class="span-ryan">toniques importés de la ville de dessus</span>. N'hésitez donc pas à venir nous dévaliser !
			</p>
		
			<img src="assets/img/Boutique/columbia.png" alt="columbia" class="columbia">

	</div>

																				<!-- DIV EACH PRODUIT -->
	<div class="produit">
		<div class="produits-wrapper" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">

<!-- NOM DU PRODUIT AVEC LIEN-->

	        <?php foreach ($produits as $produit): ?>
						<div class="name-bloc">
						<a href="index.php?page=panier/produit&id=<?=$produit['id']?>" class="produit">
						<div>
							<img src="assets/upload/<?=$produit['img']?>" alt="<?=$produit['nom']?>" class="img-produit">							
						</div>
						<div>
							<span class="nom"><?=$produit['nom']?></span>							
						</div>
	      	  </a>								
						</div>
	       		<?php endforeach; ?>		

		</div>
	</div>

<!-- PREVIOUS NEXT BUTTONS -->

	    <div class="buttons">
	        <?php if ($current_page > 1): ?>
	        <a href="index.php?page=panier/produits&p=<?=$current_page-1?>"><i class="fas fa-angle-double-left"> </i>Prev</a>
	        <?php endif; ?>
	        <?php if ($total_produits > ($current_page * $nbr_produits_sur_chaque_page) - $nbr_produits_sur_chaque_page + count($produits)): ?>
	        <a href="index.php?page=panier/produits&p=<?=$current_page+1?>">Next<i class="fas fa-angle-double-right"> </i></a>
	        <?php endif; ?>
	    </div>

			</div>

<!-- BLOC TOP BUTTON  -->

<div class="btn-top">
            <img src="assets/img/Site/submarine.png" alt="sub" id="submarine-btn">
        </div>

	</main>

</body>

<script src="assets/js/btn-top.js"></script>
<script src="assets/js/home-play-audio.js"></script>

<!-- AOS JS ANIMATION  -->

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>


