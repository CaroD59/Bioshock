<?php 
	/* Determiner le nombre de produits à afficher sur chaque page*/
	$nbr_journals_sur_chaque_page = 10;
	/* La page actuelle, apparaîtra dans l'URL  comme index.php?page=journal&p=1 ou p=2 ce signifié la page 1 l& page 2 etc...*/
	$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;

    require('assets/bdd/bddconfig.php');

     // Connecte a la base mysql
     $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
     // En cas de problème renvoie dans le catch avec l'erreur
     $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	/* Sélectionnez les produits commandés par la date ajoutée*/
	$stmt = $objBdd->prepare('SELECT * FROM journal ORDER BY date DESC LIMIT ?,?');
	/* bindValue nous permettra d'utiliser des entiers dans la déclaration SQL, que nous devons utiliser pour LIMIT.*/
	$stmt->bindValue(1, ($current_page - 1) * $nbr_journals_sur_chaque_page, PDO::PARAM_INT);
	$stmt->bindValue(2, $nbr_journals_sur_chaque_page, PDO::PARAM_INT);
	$stmt->execute();
	/* récupérer les produits de la base de données et retourner le résultat sous la forme d'un tableau.*/
	$journals = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Obtenir le nombre total de produits
	$total_journals = $objBdd->query('SELECT * FROM journal')->rowCount();
	?>

	<div class="journals content-wrapper">
	    <h1>Journals</h1>
        <a href="index.php?page=journal/create_journal" class="post"> Créer un journal</a>
	    <p><?=$total_journals?> journal</p>
	    <div class="journals-wrapper"><table><tr>
	        <?php foreach ($journals as $journal): ?>
	        <td><a href="index.php?page=journal/journals&idjournal=<?=$journal['idjournal']?>" class="journal"> <a href="index.php?page=article/articles&idjournal=<?= $journal['idjournal'] ?>"><img src="assets/upload/<?=$journal['img']?>" width="200" height="200" alt="<?=$journal['titre']?>"></a><br>
          
	            <span class="titre"><?=$journal['titre']?></span><br>
                <div>
                    <a onclick="return checkdelete()" href="assets/bdd/delete_journal.php?id= <?php echo $journal["idjournal"] ?>">Delete</a>
                    <a href="index.php?page=journal/update_post_journal&id=<?php echo $journal["idjournal"] ?>">Update</a>
                </div>
	        </a></td>
	        <?php endforeach; ?>
	               </tr></table>
	    </div>
	    <div class="buttons">
	        <?php if ($current_page > 1): ?>
	        <a href="index.php?page=journal/journal&p=<?=$current_page-1?>"><i class="fas fa-angle-double-left"> </i> Prev</a>
	        <?php endif; ?>
	        <?php if ($total_journals > ($current_page * $nbr_journals_sur_chaque_page) - $nbr_journals_sur_chaque_page + count($journals)): ?>
	        <a href="index.php?page=journal/journals&p=<?=$current_page+1?>">Next <i class="fas fa-angle-double-right"> </i></a>
	        <?php endif; ?>
	    </div>
	</div>
