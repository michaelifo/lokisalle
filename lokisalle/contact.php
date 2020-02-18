<?php require_once "functions.php" ?>

<?php require_once "header.php"; ?>

<?php

require_once "db_second.php";

if(isset($_POST['mailform']))
{
	if(!empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['message']))
	{

		$message='
		<html>
			<body>
				<div align="center">
					<br />
					<u>Nom de l\'expediteur :</u>'.$_POST['nom'].'<br />
					<u>Mail de l\'expediteur :</u>'.$_POST['mail'].'<br />
					<br />
					'.nl2br($_POST['message']).'
					<br />
				</div>
			</body>
		</html>
		';

		mail('postmaster@kazamacorp.fr', "CONTACT - https://lokisalle.kazamacorp.fr", $message, 'From:' . $_POST['mail'] );
        
        $msg="Votre message a bien été envoyé !";

	}
	else
	{
		$msg="Tous les champs doivent être complétés !";
	}
}
?>


<div class="container">
    
    <h1>Contact</h1>

    <p>Nos équipes sont à votre disposition, n'hésitez pas à nous faire part de vos problèmes rencontrer sur notre site :</p>

		<form method="POST" class="mt-4">

            <div class="form-group">
                <label for="">Nom : </label> 
                <input type="text" name="nom" class="form-control" placeholder="Votre nom" value="<?php if(isset($_POST['nom'])) { echo $_POST['nom']; } ?>" /><br /><br />
            </div>

            <div class="form-group">
                <label for="">Email : </label>    
                <input type="email" name="mail" class="form-control" placeholder="Votre email" value="<?php if(isset($_POST['mail'])) { echo $_POST['mail']; } ?>" /><br /><br />
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea">Votre message :</label>
                <textarea class="form-control" id="exampleFormControlTextarea" name="message" rows="4"><?php if(isset($_POST['message'])) { echo $_POST['message']; } ?></textarea><br /><br />
            </div>

                <button type="submit" name="mailform" class="btn btn-primary">Envoyer</button> 

		</form>

		<?php
		if(isset($msg))
		{
			echo '<p class="alert alert-warning my-4">' . $msg;
		}
		?>
</div>    


<?php require_once "footer.php"; ?>