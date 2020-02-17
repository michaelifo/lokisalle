<?php

session_start();

setcookie('remember', NULL, -1);

unset($_SESSION['auth']);

$_SESSION['flash'] ['success'] .= 'Vous êtes maintenant déconnecté <br>';

header("Location: login.php");

?>