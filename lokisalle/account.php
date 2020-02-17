<?php 

require_once "functions.php";

logged_only();

?>

<?php require_once "header.php"; ?>

<div class="container text-center">

    <h2>Bonjour <?= $_SESSION['auth']->prenom ?> <?= $_SESSION['auth']->nom; ?></h1>

    <a href="editionAccount.php">Editer mon profil</a>

    <pre>

        Nom : <?= $_SESSION['auth']->nom ?>

        Prenom : <?= $_SESSION['auth']->prenom ?>

        Pseudo : <?= $_SESSION['auth']->pseudo ?>

        Email : <?= $_SESSION['auth']->email ?>

        Sexe : <?= $_SESSION['auth']->civilite ?>

        Date d'enregistrement : <?= $_SESSION['auth']->date_enregistrement ?>

    </pre>

</div>

<?php require_once "footer.php"; ?>


