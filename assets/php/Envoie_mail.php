<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/contact.css">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<title>Contact</title>
</head>

<body>

<main>

    <!-- BLOC BIENVENUE -->

    <div class="contact">
        <h1 class="titre-contact">Formulaire de contact</h1>
    <div>
        <img src="assets/img/Site/rapture.png" alt="" class="img__rapture">
    </div>
    </div>  

    <!-- FORM -->

	<form method="post" action="assets/bdd/Envoie_mail_action.php" class=" m-auto mt-5 col-6 bg-dark text-white p-5" enctype="multipart/form-data" >

	<img src="assets/img/Site/lighthouse-rapture.png" alt="lighthouse" class="imgs-description">


	<div class="mb-3">
	<div class="div-input">
		<label for="email_from" class="form-label">Votre Email</label>
	</div>
	<div class="div-input">
		<input type="email" class="form-control" name="email_from" id="email_from" placeholder="name@example.com"  maxlength="255" minlength="3">
	</div>
	</div>
	
	<div class="mb-3">
	<div class="div-input">
		<label for="object" class="form-label">Object</label>
	</div>
	<div class="div-input">
 		<input type="text" class="form-control" name="object" id="object" placeholder="Object du mail">
	</div>
	</div>

	<div class="mb-3">
	<div class="div-input">
		<label for="body" class="form-label">Message</label>
	</div>
	<div class="div-input">
		<textarea name="body" id="body" rows="5"></textarea>
	</div>
	</div>

	<div class="mb-3">
	<div class="div-input">
  		<label for="file" class="form-label"></label>
	</div>
		<div class="div-input">
  		<input class="form-control" name="file" accept=".jpg, .jpeg, .png, .gif, .pdf" type="file" id="file">
	</div>
	</div>

	<input type="submit" class="btn-submit" value="Envoyer"/>

	<?php 
		
		if (!empty($_SESSION['message'])) {
			echo '<div class="alert col-6 m-auto alert-' . $_SESSION["alert"] . '" role="alert"> '.$_SESSION['message'].'</div>';
			unset($_SESSION['message']);
			unset($_SESSION['alert']);
		}
	?>

	<!-- BLOC PDF -->
	
	<div class="div-pdf">
	<img src="assets/img/Contact/warning.png" alt="pdf" class="warning-img">
		<p class="p-pdf">
			Pour toute demande de prise en charge à Rapture, veuillez télécharger ce document, le remplir et nous le renvoyer ci-dessus :
		</p>
		<a href="assets/pdf/prise-en-charge.pdf" target="_blank">
			<img src="assets/img/Contact/pdf.png" alt="pdf" class="pdf-img">
		</a>
	</div>

</form>

<!-- BLOC TOP BUTTON  -->

<div class="btn-top">
            <img src="assets/img/Site/submarine.png" alt="sub" id="submarine-btn">
        </div>

</main>

</body>

<script src="assets/js/btn-top.js"></script>
<script src="assets/js/home-play-audio.js"></script>

<!-- AOS JS ANIMATION  -->

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</html>