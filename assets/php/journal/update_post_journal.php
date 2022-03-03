<?php
//si different de admin alors on renvoie vers la page connexion
if($type != "admin"){
    header("location: index.php?page=connexion");
}
?>


<head>

<link rel="stylesheet" href="assets/css/.css">

</head>

     
      <main id="main">
      <h1>Modifier mon Journal</h1>

        <form name="formulaire" method="POST" action="assets/php/journal/update_journal.php">


        <input type="text" name="titre" id="titre" required />

            <input type="submit" value="Envoyer" class="envoyer" required>
            <input type="hidden" name="idjournal" value="<?php echo $_GET["id"]?>">


        </form>
        </main>
