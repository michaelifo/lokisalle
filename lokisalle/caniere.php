<?php 

require_once "functions.php"; 

require_once "header.php";

$bdd = new PDO('mysql:host=sql25;dbname=psn17421;charset=utf8', 'psn17421', 'B0hndYzwMTos');

if (isset($_POST['submit'])) {

    $user_id = $_SESSION['auth']->id_membre;

    if (isset($_POST['offert_first'])) {
        
      $offer = $_POST['offert_first'];

      $req = $bdd->prepare('INSERT INTO commande SET id_membre = ?, id_produit = ?, date_enregistrement = now()');

      $req->execute([$user_id, $offer]);
  
      header('Location: cezanne.php');

    } elseif (isset($_POST['offert_second'])) {
      
      $offer = $_POST['offert_second'];

      $req = $bdd->prepare('INSERT INTO commande SET id_membre = ?, id_produit = ?, date_enregistrement = now()');

      $req->execute([$user_id, $offer]);
        
      header('Location: cezanne.php');

    } else {

      $offer = $_POST['offert_third'];

      $req = $bdd->prepare('INSERT INTO commande SET id_membre = ?, id_produit = ?, date_enregistrement = now()');

      $req->execute([$user_id, $offer]);

      header('Location: cezanne.php');
      
    }
}

$commande = $bdd->query('SELECT commande.id_commande, 
                                commande.id_membre,
                                commande.id_produit,
                                commande.date_enregistrement,
                                membre.id_membre,
                                membre.email,
                                produit.id_produit,
                                produit.id_salle,
                                produit.date_arrivee,
                                produit.date_depart,
                                produit.prix
                         FROM commande
                         LEFT JOIN membre 
                         ON commande.id_membre = membre.id_membre
                         RIGHT JOIN produit
                         ON commande.id_produit = produit.id_produit
                         ORDER BY commande.id_commande DESC  
                         LIMIT 0,50');

?>
    

  <!-- Page Content -->
        
  <div class="container">

    <div class="row mx-auto">

      <div class="col-lg-9 bg-dark text-light">

        <div class="card mt-4 bg-dark text-light">
          <img class="card-img-top img-fluid" src="images/caniere.jpg" alt="salle caniere">
         <div class="card-body bg-dark text-light">
            <h3 class="card-title">Canière</h3>
            <div class="description">
                <h4>place : 50</h4>
                <h4>69008- Lyon</h4>
                <p class="font-weight-bold">7 rue de la folie</p>
            </div>
            <p class="card-text">Dotée d'une très grande capacité d'accueil, il est possible d'y organiser un grand rassemblement.</p>
            <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
            <span>5/5</span>
          </div>
          <div class="card-body bg-dark text-light">
            <div class="offres">
                <h4 class="card-title">Nos différentes offres:</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <input type="radio" name="offer_first" class="form-check-inline">
                        <label for="">
                            Du 01/06/2021 à 08h00 <br>
                            au 06/06/2021 à 17h00
                        </label>
                        <div class="price">
                            <br>
                            <p class="font-weight-bold">1550 €</p>
                        </div>
                        <hr>
                    </div>
                    <div class="form-group">
                        <input type="radio" name="offer_second" class="form-check-inline">
                        <label for="">
                            Du 10/06/2021 à 08h00 <br>
                            au 16/06/2021 à 17h00
                        </label>
                        <div class="price">
                            <br>
                            <p class="font-weight-bold">1850 €</p>
                        </div>
                        <hr>
                    </div>
                    <div class="form-group">
                    <input type="radio" name="offer_third" class="form-check-inline">
                        <label for="">
                            Du 20/06/2021 à 08h00 <br>
                            au 24/06/2021 à 17h00
                        </label>
                        <div class="price">
                            <br>
                            <p class="font-weight-bold">1150 €</p>
                        </div>
                        <hr>
                    </div>  
                </form>
          </div>
          <?php if (isset($_SESSION['auth'])): ?>
          <div class="mx-auto">
            <button type="submit" name="submit" class="btn btn-primary my-2">Réserver</button>
         </div>
         <?php else : ?>
            <a href="login.php">Se connecter</a>
         <?php endif; ?>      
        </div>
        <!-- /.card -->

        <div class="card card-outline-secondary my-4  bg-dark text-light">
          <div class="card-header">
            <h4>Avis</h3>
            <form action="" method="post">
                <div class="form-group my-4">
                    <label for="exampleFormControlTextarea1">On veut connaitre votre avis :</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="adresse" rows="4"></textarea>
                </div>
                <div class="form-group my-4">
            <label class="mr-sm-2" for="inlineFormCustomSelect3">Notes :</label>
            <select class="custom-select mr-sm-2" name="capacite" id="inlineFormCustomSelect3">
               <option value="" selected>Notes</option>
               <option value='1'>1</option>
               <option value='2'>2</option>
               <option value='3'>3</option>
               <option value='4'>4</option>
               <option value='5'>5</option>
            </select> 
         </div>
            </form>
          </div>
          <div class="card-body">
            <p></p>
            <small class="text-muted"></small>
            <hr>
            <?php if (isset($_SESSION['auth'])): ?>
            <a href="review.php" class="btn btn-success">Poster votre avis</a>
            <?php else : ?>
                <a href="login.php">Se connecter</a>
         <?php endif; ?>
          </div>
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col-lg-9 -->

    </div>

  </div>
  <!-- /.container -->
  <?php require_once "footer.php"; ?>