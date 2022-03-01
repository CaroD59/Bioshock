<head>
<link rel="stylesheet" href="assets/css/.css">
</head>


    <main id="main">
        
    <div class="img-preview__div" id="img-preview__div" >
        <img src="" alt="Image Preview" class="image-preview__img" />
        <span class="image-preview__default-text">Image Preview</span>
    </div>

    <form method="POST" action="assets/bdd/article_insert_action.php?idjournal=<?php echo $_GET['idjournal']?>" enctype="multipart/form-data">
        
        
        <input type="file" name="file" class="inpFile" id="inpFile"  required />

        <input type="text" name="titre" id="titre" required />Titre


        <textarea name="resume" id="resume" required placeholder="Écrivez un article" ></textarea>
       
        <input type="submit" value="Envoyer" class="envoyer" required>   <br> <br>

        </form>
        


</main>

<script src="assets/js/img-input-file.js"></script>