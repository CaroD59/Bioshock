<?php
//si different de admin alors on renvoie vers la page connexion
if($type != "admin"){
    header("location: index.php?page=connexion");
}
?>


<head>
    <link rel="stylesheet" href="assets/css/update-journal.css">
</head>

    <body>

       <main id="main">

        <!-- BLOC BIENVENUE -->

        <div class="update">
            <h1 class="titre-update">Modifier un journal</h1>
        <div>
            <img src="assets/img/Site/rapture.png" alt="" class="img__rapture">
        </div>
        </div>  

        <!-- BLOC FORM -->

            <form name="formulaire" method="POST" action="assets/php/journal/update_journal.php">

            <input type="text" name="titre" id="titre" placeholder="Modifier votre titre ici" required />
            <input type="submit" value="Envoyer" class="envoyer" required>
            <!-- hidden permet d'inclure des données qui ne peuvent pas être vues ou modifiées lorsque le formulaire est envoyé -->
            <input type="hidden" name="idjournal" value="<?php echo $_GET["id"]?>">

            </form>
        </main>   

    </body>

