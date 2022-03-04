
<?php
	/* Determiner le nombre de produits à afficher sur chaque page*/
	$nbr_articles_sur_chaque_page = 10;
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

	<div class="articles content-wrapper">
	    <h1>Articles</h1>
		<!-- si admin on voit le bouton créer -->
		<?php
		if($type == "admin"){
		?>
			<a href="index.php?page=article/create_article&idjournal=<?php echo $_GET['idjournal'] ?>" class="post"> Créer un article</a>
			
		<?php
		}
		?>	    
		<p><?=$total_articles?> article</p>
	    <div class="articles-wrapper"><table><tr>
	        <?php foreach ($articles as $article): ?>
	        <td><a href="index.php?page=article/articles&idarticle=<?=$article['idarticle']?>" class="articles"> <a href="index.php?page=journal/journals&idarticle=<?= $article['idarticle'] ?>"><img src="assets/upload/<?=$article['img']?>" width="200" height="200" alt="<?=$article['titre']?>"></a><br>
          
	            <span class="titre"><?=$article['titre']?></span><br>
	            <span class="resume"><?=$article['resume']?></span><br>
				<!-- si admin on voit les boutton update et delete -->
				<?php
				if($type == "admin"){
					?>			
                <div>
                    <a href="assets/bdd/delete_article.php?id= <?php echo $article["idarticle"] ?>">Delete</a>
                    <a href="index.php?page=article/update_post_article&id=<?php echo $article["idarticle"] ?>">Update</a>
                </div>
				<?php
			}
			?>
	        </a></td>
	        <?php endforeach; ?>
	               </tr></table>
	    </div>
	    <div class="buttons">
	        <?php if ($current_page > 1): ?>
	        <a href="index.php?page=article/article&p=<?=$current_page-1?>"><i class="fas fa-angle-double-left"> </i> Prev</a>
	        <?php endif; ?>
	        <?php if ($total_articles > ($current_page * $nbr_articles_sur_chaque_page) - $nbr_articles_sur_chaque_page + count($articles)): ?>
	        <a href="index.php?page=article/articles&p=<?=$current_page+1?>">Next <i class="fas fa-angle-double-right"> </i></a>
	        <?php endif; ?>
	    </div>
	</div>
