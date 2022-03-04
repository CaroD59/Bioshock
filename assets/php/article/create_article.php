<?php
//si different de admin alors on renvoie vers la page connexion
if($type != "admin"){
    header("location: index.php?page=connexion");
}
?>


<head>
    <link rel="stylesheet" href="assets/css/create-article.css">
</head>

<body>

    <main id="main">

    <!-- BLOC BIENVENUE -->

    <div class="article">
            <h1 class="titre-article">Creer un article</h1>
        <div>
            <img src="assets/img/Site/rapture.png" alt="" class="img__rapture">
        </div>
        </div>  

    <div class="bloc-img">
        <div class="img-preview__div" id="img-preview__div" >
            <img src="" alt="Image Preview" class="image-preview__img" />
            <span class="image-preview__default-text">Image Preview</span>
        </div>
    </div>

    <form method="POST" action="assets/bdd/article_insert_action.php?idjournal=<?php echo $_GET['idjournal']?>" enctype="multipart/form-data">
        
    <div class="form">
        <div>
        <input type="file" name="file" class="inpFile" id="inpFile" required />
        </div>
        <div>
        <input type="text" name="titre" id="titre" class="titre" placeholder="Écrivez votre titre ici" required />
        </div>
        <div>
        <textarea name="resume" id="resume" class="titre" required placeholder="Écrivez votre article ici" ></textarea>
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