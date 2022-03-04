<?php
//si different de admin alors on renvoie vers la page connexion
if($type != "admin"){
    header("location: index.php?page=connexion");
}
?>


<head>
<link rel="stylesheet" href="assets/css/create-journal.css">
</head>

<body>
    
    <main id="main">

<!-- BLOC BIENVENUE -->

        <div class="journal">
            <h1 class="titre-journal">Creer un journal</h1>
        <div>
            <img src="assets/img/Site/rapture.png" alt="" class="img__rapture">
        </div>
        </div>  

<!-- FORM -->

        <div class="bloc-img">
    <div class="img-preview__div" id="img-preview__div" >
        <img src="" alt="Image Preview" class="image-preview__img" />
        <span class="image-preview__default-text">Image Preview</span>
    </div>
       </div>

    <form method="POST" action="assets/bdd/journal_insert_action.php" enctype="multipart/form-data">
    
    <div class="form">
        <div>
        <input type="file" name="file" class="inpFile" id="inpFile"  required />            
        </div>

        <div>
        <input type="text" name="titre" id="titre" placeholder="Écrivez votre titre ici" required />            
        </div>

        <div>
        <input type="submit" value="Envoyer" class="envoyer" required>
        </div>        
    </div>

    </form>

    </main>

</body>

<!-- SCRIPT POUR UPLOAD IMG -->

<script src="assets/js/img-input-file.js"></script>