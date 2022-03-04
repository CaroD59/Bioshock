<?php

if($type != "admin"){
    header("location: index.php?page=connexion");
}
?>




<head>
    <link rel="stylesheet" href="assets/css/create-produit.css">
</head>

<body>

    <main id="main">

<!-- BLOC BIENVENUE -->

        <div class="produit">
            <h1 class="titre-produit">Creer un produit</h1>
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

        <form method="POST" action="assets/bdd/produit_insert_action.php" enctype="multipart/form-data">
        
        <div class="form">
        <div>
        <input type="file" name="file" class="inpFile" id="inpFile" required />            
        </div>

        <div>
        <input type="text" name="nom" id="nom" class="titre" placeholder="Nom du produit" required />            
        </div>

        <div>
        <input type="number" name="prix" id="prix" class="titre" placeholder="Prix du produit" required />            
        </div>

        <div>
        <input type="number" name="prixReel" id="prixRéel" class="titre" placeholder="Prix réel du produit" required />
        </div>

        <div>
        <input type="number" name="quantite" id="quantité" class="titre" placeholder="Quantité en stock" required />        
        </div>

        <div>
        <textarea name="description" id="description" class="titre" required placeholder="Écrivez une description" maxlength="200"></textarea>
        </div>

        <div>
            <input type="submit" value="Envoyer" class="envoyer" required>
        </div>            
        </div>
 
            
        </form>

    </main>  

</body>


<script src="assets/js/img-input-file.js"></script>
