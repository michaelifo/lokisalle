<?php



$user_id = $_GET['id'];

$token = $_GET['token'];

require_once "db.php";

$req = $bdd->prepare('SELECT * FROM membre WHERE id_membre = ?');

$req->execute([$user_id]);

$user = $req->fetch();

session_start();

if($user && $user->confirmation_token == $token) {

    $bdd->prepare('UPDATE membre SET confirmation_token = NULL, confirmed_at = NOW() WHERE id_membre = ?')->execute([$user_id]);

    $_SESSION['flash']['success'] = "Votre compte a bien été validé";

    $_SESSION['auth'] = $user;

    header('Location: account.php');
} else {

    $_SESSION['flash']['danger'] = "Ce token n'est plus valide";

    header('Location: login.php');
}

