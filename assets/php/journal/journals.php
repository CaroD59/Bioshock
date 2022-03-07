<?php 
	/* Determiner le nombre de produits à afficher sur chaque page*/
	$nbr_journals_sur_chaque_page = 100;
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

    // Obtenir le nombre total de journaux
	$total_journals = $objBdd->query('SELECT * FROM journal')->rowCount();
	?>


<!-- PAGE -->

<head>
	<link rel="stylesheet" href="assets/css/journaux.css">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
	
	<main>
<!-- BLOC BIENVENUE -->

		<div class="journaux">
        <h1 class="titre-journaux">Marchand de Journaux</h1>
    	<div>
        <img src="assets/img/Site/rapture.png" alt="" class="img__rapture">
    	</div>
    </div> 

<!-- BLOC JOURNAUX -->

		<div class="Bloc-Journaux">

<!-- SI ADMIN = BOUTON CREER JOURNAL -->
		<?php
		if($type == "admin"){
		?>
		<div class="create-for-ryan">
			<a href="index.php?page=journal/create_journal" class="post">
			<img src="assets/img/Boutique/plus.png" alt="plus" class="plus">
			Creer un journal</a>
		</div>
			<p class="produits-dispos">
			<span class="number-produits"><?=$total_journals?></span> journaux disponibles
			</p>			
		<?php
		}
		?>	 

<!-- PRESENTATION -->

		<div class="presentation" data-aos="flip-up">

			<img src="assets/img/Site/lighthouse-rapture.png" alt="lighthouse" class="imgs-description">

			<p class="titre-description">
			Bienvenue au marchand de journaux de <span class="span-ryan">Rapture</span>, où vous y trouverez le <span class="span-ryan">Rapture Tribune</span>, disponible chaque semaine !
			</p>
			<p class="text-description">
			Chez votre marchand de journaux préféré vous y trouverez, en plus de votre journal hebdomadaire et <span class="span-ryan">gratuit</span>, une spacieuse salle de lecture avec une <span class="span-ryan">radio</span> à disposition de nos clients. Pour activer la radio pendant que vous lisez tranquillement votre journal, veuillez, <span class="span-ryan">je vous pris</span>, l'activer ici.
			</p>

			<img src="assets/img/Journal/radio-logo.png" alt="radio" class="radio">

			<div class="audios">
        <img src="assets/img/Site/play.png" alt="" class="play-audio" id="play-audio">
        <img src="assets/img/Site/pause.png" alt="" class="play-audio" id="pause-audio">
        <audio src="assets/sons/radio.mp3" id="audio"></audio>
    	</div>



		</div>

<!-- JOURNAUX -->
	    <div class="journaux-dispos" data-aos="fade-down">

	        <?php foreach ($journals as $journal): ?>
					<div class="bloc">
	        <a href="index.php?page=journal/journals&idjournal=<?=$journal['idjournal']?>" class="journal">
					<a href="index.php?page=article/articles&idjournal=<?= $journal['idjournal'] ?>" target="_blank">
					<img src="assets/upload/<?=$journal['img']?>" alt="<?=$journal['titre']?>" class="img-journal"></a>
					</div>
					<div class="titre-journal">
	        <span class="titre"><?=$journal['titre']?></span>						
					</div>
<!-- SI ADMIN BOUTONS SUPPRIMER ET MODIFIER  -->
				<?php
				if($type == "admin"){
					?>
				
                <div class="btns-gestion">
                    <a href="assets/bdd/delete_journal.php?id= <?php echo $journal["idjournal"] ?>"><img src="assets/img/Boutique/delete.png" alt="" class="btns"></a>
                    <a href="index.php?page=journal/update_post_journal&id=<?php echo $journal["idjournal"] ?>"><img src="assets/img/Journal/edit.png" alt="" class="btns"></a>
                </div>
				<?php			
			}
			?>
	        				</a>
	        <?php endforeach; ?>

	    </div>

			<!-- BOUTONS NEXT / PREVIOUS -->
	    <div class="buttons">
	        <?php if ($current_page > 1): ?>
	        <a href="index.php?page=journal/journal&p=<?=$current_page-1?>"><i class="fas fa-angle-double-left"> </i> Prev</a>
	        <?php endif; ?>
	        <?php if ($total_journals > ($current_page * $nbr_journals_sur_chaque_page) - $nbr_journals_sur_chaque_page + count($journals)): ?>
	        <a href="index.php?page=journal/journals&p=<?=$current_page+1?>">Next <i class="fas fa-angle-double-right"> </i></a>
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