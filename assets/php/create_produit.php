<head>
<link rel="stylesheet" href="assets/css/.css">
</head>

<!-- C du crud / CREER nouveau post -->


    <main id="main">
        
    <div class="img-preview__div" id="img-preview__div" >
        <img src="" alt="Image Preview" class="image-preview__img" />
        <span class="image-preview__default-text">Image Preview</span>
    </div>

    <form method="POST" action="assets/bdd/produit_insert_action.php" enctype="multipart/form-data">
        
        
        <input type="file" name="file" class="inpFile" id="inpFile"  required />
            
            <textarea name="legende" id="legende" required placeholder="Écrivez une légende" maxlength="200"></textarea>  <br> <br>
            <div id="compteur" style="text-align:right"> 0 / 200</div>

            <input type="submit" value="Envoyer" class="envoyer" required>   <br> <br>

        </form>


</main>

<script src="assets/js/img-input-file.js"></script>
