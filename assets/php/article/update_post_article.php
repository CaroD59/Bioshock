<?php
//si different de admin alors on renvoie vers la page connexion
if($type != "admin"){
    header("location: index.php?page=connexion");
}
?>


<head>
    <link rel="stylesheet" href="assets/css/update-article.css">
</head>

<body>
    
    <main id="main">

        <!-- BLOC BIENVENUE -->

        <div class="update">
            <h1 class="titre-update">Modifier un article</h1>
        <div>
            <img src="assets/img/Site/rapture.png" alt="" class="img__rapture">
        </div>
        </div>  

        <!-- BLOC FORM -->


        <form name="formulaire" method="POST" action="assets/php/article/update_article.php">


            <input type="text" name="titre" id="titre" placeholder="Modifier votre titre ici" required />
            <textarea name="resume" id="resume" placeholder="Modifier votre article ici" required ></textarea>
            <input type="submit" value="Envoyer" class="envoyer" required>
            <input type="hidden" name="idarticle" value="<?php echo $_GET["id"]?>">


        </form>

    </main>

</body>
     
