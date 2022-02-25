

<link rel="stylesheet" href="assets/css/style_profil_update.css">
<h3>Modification Du Profil</h3>
    <div class="container_profil">

<form method="POST" id="form" action="assets/bdd/profil_update_action.php">

    <div class="profil">
    <input placeholder="Nom" type="text" name="nom" required>
    </div>
<hr>
    <div class="profil">
    <input placeholder="Prénom" type="text" name="prenom" required>
    </div>

<hr>
    <div class="profil">
    <input placeholder="Email" type="text" name="email" required>
    </div>
<hr>
    <div class="profil">
    <input placeholder="Mot de Passe" type="password" name="mdp" required>
    </div>
<hr>
    <div class="profil">
    <input placeholder="Confirmer le Mot de Passe" type="password" name="mdp2" required>
    </div>
    <hr>
</div>
   
<div class="profil1">
            <input id="envoyer" type="submit" value="Enregistrer ">
        </div>
</form>




</body>

</html>