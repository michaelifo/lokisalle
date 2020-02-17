<?php 
    if (session_status() == PHP_SESSION_NONE) {
        
        session_start();
    }
    
 ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <title>Lokisalle</title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class= "logo container-fluid mr-auto">
                    <a href="index.php">
                        <img class="img-fluid"src="images/logo_lokisalle.png" alt="logo lokisalle">
                    </a>
                </div>
                <?php
                    require_once "nav.php";
                ?>
                <?php if (isset($_SESSION['flash'])): ?>

                    <?php foreach($_SESSION['flash'] as $type => $message): ?>
                        <div class="alert alert-<?= $type; ?>">
                            <?= $message; ?>
                        </div>
                    <?php endforeach; ?>

                    <?php unset($_SESSION['flash']); ?>

                <?php endif; ?>   
            </div>
        </div>    
            
        