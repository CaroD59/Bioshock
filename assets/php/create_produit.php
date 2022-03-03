<?php

if($type != "admin"){
    header("location: index.php?page=connexion");
}
?>




<head>
<link rel="stylesheet" href="assets/css/.css">
</head>


    <main id="main">
        
    <div class="img-preview__div" id="img-preview__div" >
        <img src="" alt="Image Preview" class="image-preview__img" />
        <span class="image-preview__default-text">Image Preview</span>
    </div>

    <form method="POST" action="assets/bdd/produit_insert_action.php" enctype="multipart/form-data">
        
        
        <input type="file" name="file" class="inpFile" id="inpFile"  required />

        <input type="text" name="nom" id="nom" required />nom
        <input type="number" name="prix" id="prix" required />prix
        <input type="number" name="prixReel" id="prixRéel" required />prixRéel
        <input type="number" name="quantite" id="quantité" required />quantité
            
            <textarea name="description" id="description" required placeholder="Écrivez une description" maxlength="200"></textarea>  <br> <br>

            <input type="submit" value="Envoyer" class="envoyer" required>   <br> <br>

        </form>


</main>

<script src="assets/js/img-input-file.js"></script>
