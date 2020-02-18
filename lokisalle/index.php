<?php

require_once "functions.php"; 

require_once "header.php";

require_once "db_second.php";


$products = $bdd->prepare('SELECT etat FROM produit');

$products->execute();



$p = $products->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="container">
    <h1>LOKISALLE : LA RÉFÉRENCE EN LOCATION DE SALLE !</h1>

    <div class="row">


        <div class="col-lg-9 mx-auto">

            <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid" src="images/cezanne.jpg" alt="salle cezanne">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="images/mozart.jpg" alt="salle mozart">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="images/voltaire.jpg" alt="salle voltaire">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="cezanne.php?etat=<?= implode(",", $p[0]); ?>&id_produit=1"><img class="card-img-top" src="images/cezanne.jpg" alt="salle cezanne"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="cezanne.php?etat=<?= implode(",", $p[0]); ?>&id_produit=1">Cézanne</a>
                            </h4>
                            <h5>place : 30</h5>
                            <p class="card-text">La salle cézanne parfaite pour vos réunions d'entreprise</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="mozart.php?etat=<?= implode(",", $p[1]); ?>&id_produit=2"><img class="card-img-top" src="images/mozart.jpg" alt="salle mozart"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="mozart.php?etat=<?= implode(",", $p[1]); ?>&id_produit=2">Mozart</a>
                            </h4>
                            <h5>place : 5</h5>
                            <p class="card-text">Cette salle vous permettra de recevoir vos collaborateurs en petit comité</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9733;</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="picasso.php?etat=<?= implode(",", $p[2]); ?>&id_produit=3"><img class="card-img-top" src="images/picasso.jpg" alt="salle picasso"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="picasso.php?etat=<?= implode(",", $p[2]); ?>&id_produit=3">Picasso</a>
                            </h4>
                            <h5>place : 14</h5>
                            <p class="card-text">Cette salle vous permettra de conférencer avec vos collègues</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="voltaire.php?etat=<?= implode(",", $p[3]); ?>&id_produit=4"><img class="card-img-top" src="images/voltaire.jpg" alt="salle voltaire"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="voltaire.php?etat=<?= implode(",", $p[3]); ?>&id_produit=4">Voltaire</a>
                            </h4>
                            <h5>place : 9</h5>
                            <p class="card-text">Cette salle, vous étonnera par ses nombreuses fonctionnalités.</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9733;</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="nation.php?etat=<?= implode(",", $p[4]); ?>&id_produit=5"><img class="card-img-top" src="images/nation.jpg" alt="salle nation"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="nation.php?etat=<?= implode(",", $p[4]); ?>&id_produit=5">Nation</a>
                            </h4>
                            <h5>place : 22</h5>
                            <p class="card-text">Cette salle met l'accent sur la convivialité et la sérénité.</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9733;</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="caniere.php?etat=<?= implode(",", $p[5]); ?>&id_produit=6"><img class="card-img-top" src="images/caniere.jpg" alt="salle caniere"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="caniere.php?etat=<?= implode(",", $p[5]); ?>&id_produit=6">Caniere</a>
                            </h4>
                            <h5>place : 50</h5>
                            <p class="card-text">Dotée d'une très grande capacité d'accueil, il est possible d'y organiser un grand rassemblement.</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9733;</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>  

<?php require_once "footer.php"; ?>
