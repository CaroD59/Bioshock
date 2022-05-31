<?php
// on active les variables de session
session_start();

// lance les classes de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;

require_once('../../PHPMailer/src/Exception.php');
require_once('../../PHPMailer/src/OAuth.php');
require_once('../../PHPMailer/src/PHPMailer.php');
require_once('../../PHPMailer/src/POP3.php');
require_once('../../PHPMailer/src/SMTP.php');


echo !extension_loaded('openssl')?"Not Available":"Available";

define('GMailUSER', 'testfoadsofip@gmail.com'); // utilisateur Gmail
define('GMailPWD', 'foadtest'); // Mot de passe Gmail

// $to = htmlspecialchars($_POST["email_to"]);
$from = htmlspecialchars($_POST["email_from"]);
$subject= htmlspecialchars($_POST["object"]);
$body = htmlspecialchars($_POST["body"]);


function smtpMailer( $from, $subject, $body) {
	
	// on va dans la fonction uploadfichier
	$piece_jointe = uploadfichier();
	
	$mail = new PHPMailer();  // Cree un nouvel objet PHPMailer
	$mail->IsSMTP(); // active SMTP	// $mail->SMTPKeepAlive = true; 	// $mail->Mailer = “smtp” ;
	// $mail->SMTPDebug = 3;  // debogage: 1 = Erreurs et messages, 2 = messages seulement
	$mail->SMTPAuth = true;  // Authentification SMTP active
	$mail->SMTPSecure = 'ssl'; // Gmail REQUIERT Le transfert securise
	$mail->Host = 'ssl://smtp.gmail.com';
	$mail->Port = 465;
	$mail->Username = GMailUSER;
	$mail->Password = GMailPWD;
	$mail->SetFrom($from);
	$mail->Subject = $subject;
	if($piece_jointe != "") {
		$mail->addAttachment('../upload/'.$piece_jointe);
	}
	$mail->Body = $body;
	$mail->AddAddress('testfoadsofip@gmail.com');
	
	if(!$mail->Send()) {
		return 'Mail error: '.$mail->ErrorInfo;
		
		$_SESSION["message"] = "Une erreur est survenue, veuillez réessayer ultérieurement...";
		$_SESSION['alert'] = "danger";
			
		header("Location: index.php");

	} else {
		echo "Message envoyé !";

		$_SESSION["message"] = "Votre dernier mail a bien été envoyé.";
		$_SESSION['alert'] = "success";
		
		header("Location: ../../index.php");
	}
}

function uploadfichier(){

	// PHP lui donne un nom temporaire
	$tmpName = $_FILES['file']['tmp_name'];
	// le nom du fichier
	$name = $_FILES['file']['name'];
	// recup la taille de t'image
	$size = $_FILES['file']['size'];
	// on recup les erreurs si il y en a 
	$error = $_FILES['file']['error'];

	if(isset($_FILES['file'])){
		// explode sépare la chaine => ( image.jpg -> ["image", "jpg"] ) Agis comme un split(".") en js 
		$tabExtension = explode('.', $name);
		//strtolower met en minuscule tout une String
		$extension = strtolower(end($tabExtension));
		//Extensions des images qu'on accepte seulement
		$extensions = ['jpg', 'png', 'jpeg', 'gif', 'pdf'];
		//Va permettre la vérification de la taille (ici c'est la taille a ne pas dépasser)
		$maxSize = 10000000;

		if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
			//Avoir un nom unique par fichier
			$uniqueName = uniqid('', true);
			// on "créer" le nom du fichier 
			$file = $uniqueName.".".$extension;
			// Déplace le fichier vers notre dossier upload
			move_uploaded_file($tmpName, '../upload/'.$file);
			// on return le nom du fichier 
			return $file;	
		}
	}else{
		return "aucun";
	}

}

$result = smtpmailer($from,$subject, $body);