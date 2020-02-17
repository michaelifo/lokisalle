<?php require_once "functions.php"; ?>

<?php require_once "header.php"; ?>

<?php 

if (!empty($_POST) && !empty($_POST['email'])) {
    
    require "db.php";

    $req = $bdd->prepare('SELECT * FROM membre WHERE email = ? AND confirmed_at IS NOT NULL');

    $req->execute([$_POST['email']]);

    $user = $req->fetch();


    if ($user) {

        session_start();

        $reset_token = str_random(60);

        $bdd->prepare('UPDATE membre SET reset_token = ?, reset_at = NOW() WHERE id_membre = ?')->execute([$reset_token, $user->id_membre]);

        $_SESSION['flash']['success'] = "Les instructions du rappel de mot de passe vous ont été envoyées par emails";

        mail($_POST['email'], 'Reinitialisation de votre mot de passe', "Afin de Reinitialiser votre mot de passe merci de cliquer sur ce lien\n\nhttps://lokisalle.kazamacorp.fr/reset.php?id={$user->id_membre}&token=$reset_token", 'From: postmaster@kazamacorp.fr');

        header('Location: login.php');

        exit();
    } else {
        $_SESSION['flash']['danger'] = "Aucun compte ne correspond à cet adresse";
    }
}

?>



<div class="container">
    
    <h1 class="text-left">Mot de passe oublié</h1>

    <form method="POST" class="mt-4">

        <div class="form-group">

            <label for="">Email</label>

            <input type="email" name="email" class="form-control" >

        </div>

        <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>  
  
    </form>
</div>

<?php require_once "footer.php"; ?>


