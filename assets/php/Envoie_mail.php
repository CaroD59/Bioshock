<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Contact</title>

</head>
<body>
	
	
<form method="post" action="assets/bdd/Envoie_mail_action.php" class=" m-auto mt-5 col-6 bg-dark text-white p-5" enctype="multipart/form-data" >

	<h2 class="p-2" >Formulaire de contact</h2>

	<div class="mb-3">
		<label for="email_to" class="form-label">Email d'Andrew Ryan</label>
		<input type="email" class="form-control" name="email_to" id="email_to" placeholder="name@example.com" maxlength="255" minlength="3">
	</div>

	<div class="mb-3">
		<label for="email_from" class="form-label">Votre Email</label>
		<input type="email" class="form-control" name="email_from" id="email_from" placeholder="name@example.com"  maxlength="255" minlength="3">
	</div>

	
	<div class="mb-3">
		<label for="object" class="form-label">Object</label>
 		<input type="text" class="form-control" name="object" id="object" placeholder="Object du mail">
	</div>



	<div class="mb-3">
		<label for="body" class="form-label">Message</label>
		<textarea class="form-control" name="body" id="body" rows="5"></textarea>
	</div>

	<div class="mb-3">
  		<label for="file" class="form-label">Fichier </label>
  		<input class="form-control" name="file" accept=".jpg, .jpeg, .png, .gif, .pdf" type="file" id="file">
	</div>

	<input type="submit" class="btn btn-primary mb-3" value="Envoyer"/>

	<?php 
		
		if (!empty($_SESSION['message'])) {
			echo '<div class="alert col-6 m-auto alert-' . $_SESSION["alert"] . '" role="alert"> '.$_SESSION['message'].'</div>';
			unset($_SESSION['message']);
			unset($_SESSION['alert']);
		}
	?>
	
</form>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>