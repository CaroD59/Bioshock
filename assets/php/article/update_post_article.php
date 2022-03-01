<head>

<link rel="stylesheet" href="assets/css/.css">

</head>

     
      <main id="main">
      <h1>Modifier mon Article</h1>

        <form name="formulaire" method="POST" action="assets/php/article/update_article.php">


        <input type="text" name="titre" id="titre" required />

        <textarea name="resume" id="resume" required placeholder="Écrivez un article"></textarea>

            <input type="submit" value="Envoyer" class="envoyer" required>
            <input type="hidden" name="idarticle" value="<?php echo $_GET["id"]?>">


        </form>
        </main>