
<?php
	/* Determiner le nombre de produits à afficher sur chaque page*/
	$nbr_articles_sur_chaque_page = 100;
	/* La page actuelle, apparaîtra dans l'URL  comme index.php?page=journal&p=1 ou p=2 ce signifié la page 1 l& page 2 etc...*/
	$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
	
	$idjournal = $_GET['idjournal'];
    require('assets/bdd/bddconfig.php');

     // Connecte a la base mysql
     $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
     // En cas de problème renvoie dans le catch avec l'erreur
     $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	/* Sélectionnez les produits commandés par la date ajoutée*/
	$stmt = $objBdd->prepare('SELECT * FROM article WHERE idjournal = ? ORDER BY date DESC LIMIT ?,?');
	/* bindValue nous permettra d'utiliser des entiers dans la déclaration SQL, que nous devons utiliser pour LIMIT.*/
	$stmt->bindValue(1, $idjournal, PDO::PARAM_INT);
	$stmt->bindValue(2, ($current_page - 1) * $nbr_articles_sur_chaque_page, PDO::PARAM_INT);
	$stmt->bindValue(3, $nbr_articles_sur_chaque_page, PDO::PARAM_INT);
	$stmt->execute();
	/* récupérer les produits de la base de données et retourner le résultat sous la forme d'un tableau.*/
	$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // Obtenir le nombre total de produits
	$stmt2 = $objBdd->prepare('SELECT * FROM article WHERE idjournal = ?');
	/* bindValue nous permettra d'utiliser des entiers dans la déclaration SQL, que nous devons utiliser pour LIMIT.*/
	$stmt2->bindValue(1, $idjournal, PDO::PARAM_INT);
	$stmt2->execute();	
	$total_articles = $stmt2->rowCount();
	// var_dump($total_articles)

	?>

	<head>
		<link rel="stylesheet" href="assets/css/article.css">
	</head>

	<body>
		
			<main>

	<div class="articles">

<!-- SI ADMIN = BOUTON CREER ARTICLE -->
		<?php
		if($type == "admin"){
		?>
		<div class="create-for-ryan">
			<a href="index.php?page=article/create_article&idjournal=<?php echo $_GET['idjournal'] ?>" class="post">
			<img src="assets/img/Boutique/plus.png" alt="plus" class="plus">
				Creer un article</a>
		</div>
		<p class="produits-dispos">
		<span class="number-produits"><?=$total_articles?></span> article(s) disponible(s) pour ce journal
			</p>			
		<?php
		}
		?>	    

	    <div class="Bloc-Articles">
				<h1 class="titre-journal">Rapture Tribune</h1>
	        <?php foreach ($articles as $article): ?>
					<div class="article-section">
						<div class="imgs-articles">
						<!-- IMAGE DE L'ARTICLE -->
							<a href="index.php?page=article/articles&idarticle=<?=$article['idarticle']?>" class="articles"> <a href="index.php?page=journal/journals&idarticle=<?= $article['idarticle'] ?>">
								<img src="assets/upload/<?=$article['img']?>" alt="<?=$article['titre']?>" class="image-article">
							</a>
						</div>
						<div class="descriptions">
							<div class="titre">
						<!-- TITRE DE L'ARTICLE  -->
	            <span><?=$article['titre']?></span>
							</div>
							<div class="resume">
						<!-- RESUME DE L'ARTICLE -->
	            <span><?=$article['resume']?></span>								
							</div>
						</div>
					</div>


<!-- SI ADMIN BOUTONS SUPPRIMER ET MODIFIER  -->
					<?php
					if($type == "admin"){
					?>			
                <div class="btns-gestion">
                    <a href="assets/bdd/delete_article.php?id=<?php echo $article["idarticle"] ?>"><img src="assets/img/Journal/delete2.png" alt="" class="btns"></a>
                    <a href="index.php?page=article/update_post_article&id=<?php echo $article["idarticle"] ?>"><img src="assets/img/Journal/edit2.png" alt="" class="btns"></a>
                </div>
					<?php
			}
			?>
	        					</a>
	        <?php endforeach; ?>

	    </div>

			<!-- BOUTONS NEXT / PREVIOUS  -->
	    <div class="buttons">
	        <?php if ($current_page > 1): ?>
	        <a href="index.php?page=article/article&p=<?=$current_page-1?>"><i class="fas fa-angle-double-left"> </i> Prev</a>
	        <?php endif; ?>
	        <?php if ($total_articles > ($current_page * $nbr_articles_sur_chaque_page) - $nbr_articles_sur_chaque_page + count($articles)): ?>
	        <a href="index.php?page=article/articles&p=<?=$current_page+1?>">Next <i class="fas fa-angle-double-right"> </i></a>
	        <?php endif; ?>
	    </div>

	</div>

	<!-- BOUTON RETURN -->

	<div class="return-div">
            <a href="index.php?page=journal/journals">
                <img src="assets/img/Site/return.png" alt="return" class="return">            
            </a>
      </div>

			</main>

	</body>


