<?php 

require_once "functions.php"; 

require_once "header.php";

require_once "db_second.php";



if (!empty($_POST['commentaire']) AND !empty($_POST['note'])) {

  $user_id = $_SESSION['auth']->id_membre;

  $req = $bdd->prepare('INSERT INTO avis SET id_membre = ?, id_salle = ?, commentaire = ?, note = ?, date_enregistrement = now()');

  $req->execute([$user_id, '5', $_POST['commentaire'], $_POST['note']]);

  $_SESSION['flash']['success'] .= "Votre avis a bien été posté ! <br>";

  header('Location: nation.php?etat=<?= implode(",", $p[4]); ?>&id_produit=5');

}

$avis = $bdd->query('SELECT a.id_avis AS avis_id,
                                 a.id_membre AS a_membreid,
                                 a.id_salle AS a_salleid,
                                 a.commentaire AS a_com,
                                 a.note AS note_a,
                                 a.date_enregistrement AS ade,
                                 m.id_membre AS membreid,
                                 m.email AS emailm,
                                 s.id_salle AS salleid,
                                 s.titre AS stitre
                         FROM avis AS a
                         LEFT JOIN membre AS m
                         ON a.id_membre = m.id_membre
                         RIGHT JOIN salle AS s
                         ON a.id_salle = s.id_salle
                         GROUP BY a.id_avis,
                                  a.id_membre, 
                                  a.id_salle, 
                                  a.commentaire, 
                                  a.note, 
                                  a.date_enregistrement 
                         ORDER BY a.id_avis DESC  
                         LIMIT 0,50');

if (isset($_GET['etat']) AND isset($_POST['submit'])) {

  if (!empty($_POST['date_arrivee']) AND !empty($_POST['date_depart']) AND !empty($_POST['price']) AND $_GET['etat'] == 'libre') {

    $id_produit = (int) $_GET['id_produit'];
  
    $user_id = $_SESSION['auth']->id_membre;
  
    $req = $bdd->prepare('SELECT id_produit FROM produit WHERE etat = ?');
  
    $req->execute(['reservation']);
  
    $req = $bdd->prepare('UPDATE produit SET etat = ? WHERE id_produit = ?');
  
    $req->execute(['reservation', $id_produit]);
        
    $req = $bdd->prepare('INSERT INTO commande SET id_membre = ?, id_produit = ?, date_enregistrement = now()');
  
    $req->execute([$user_id, '5']);
  
    $_SESSION['flash']['success'] .= "félicitations pour votre reservation ! <br>";
  
    header('Location: nation.php?etat=<?= implode(",", $p[4]); ?>&id_produit=5');
  } else {

    $errors['submit'] = "Désolé mais cette salle est déjà réservé !";
    
  }

} 



$commandes = $bdd->query('SELECT c.id_commande AS commandeid,
                                 c.id_membre AS cmembreid,
                                 c.id_produit AS cproduitid,
                                 c.date_enregistrement AS cde,
                                 m.id_membre AS membreid,
                                 m.email AS emailm,
                                 p.id_produit AS produitid,
                                 p.id_salle AS psalleid,
                                 p.date_arrivee AS pda,
                                 p.date_depart AS pdd,
                                 p.prix AS pprix,
                                 s.id_salle AS salleid,
                                 s.titre AS stitre
                         FROM commande AS c
                         LEFT JOIN membre AS m
                         ON c.id_membre = m.id_membre
                         RIGHT JOIN produit AS p
                         ON c.id_produit = p.id_produit
                         RIGHT JOIN salle AS s
                         ON p.id_salle = s.id_salle 
                         ORDER BY c.id_commande ASC  
                         LIMIT 0,50');

?>


<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
      <ul>
        <?php foreach ($errors as $error): ?>
        <li><?= $error; ?></li>
        <?php endforeach; ?>  
      </ul>
    </div>
<?php endif; ?>     

  <!-- Page Content -->
        
  <div class="container">

    <div class="row mx-auto">

      <div class="col-lg-9 bg-dark text-light">

        <div class="card mt-4 bg-dark text-light">
          <img class="card-img-top img-fluid" src="images/nation.jpg" alt="salle nation">
         <div class="card-body bg-dark text-light">
            <h3 class="card-title">Nation</h3>
            <div class="description">
                <h4>place : 22</h4>
                <h4>75014 - Paris</h4>
                <p class="font-weight-bold">27 rue de la nation</p>
            </div>
            <p class="card-text">Cette salle met l'accent sur la convivialité et la sérénité.</p>
            <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9733;</span>
            <span>5/5</span>
          </div>
          <div class="card-body bg-dark text-light">
          <form action="" method="post">
            <div class="offres">
                <h4 class="card-title">Nos différentes offres:</h3>
                <div class="form-group my-4">

                <label class="mr-sm-2" for="inlineFormCustomSelect">Du</label>

                <select class="custom-select mr-sm-2" name="date_arrivee" id="inlineFormCustomSelect">

                  <option value='2021-05-01 08:00:00' selected>2021-05-01 08:00:00 </option>

                </select>
               
              </div>

              <div class="form-group my-4">

                <label class="mr-sm-2" for="inlineFormCustomSelect2">Au</label>

                <select class="custom-select mr-sm-2" name="date_depart" id="inlineFormCustomSelect2">
            
                  <option value='2021-05-16 17:00:00' selected>2021-05-16 17:00:00</option>

                </select>
               
              </div>

              <div class="form-group my-4">

                <label class="mr-sm-2" for="inlineFormCustomSelect3">Prix</label>

                <select class="custom-select mr-sm-2" name="price" id="inlineFormCustomSelect3">
          
                  <option value='1050' selected>1050 €</option>

                </select>
               
              </div>

              <div class="form-group my-4">
                <label class="mr-sm-2" for="inlineFormCustomSelect4">État</label>
                <select class="custom-select mr-sm-2" name="etat" id="inlineFormCustomSelect4">
                <?php if($_GET['etat'] == 'libre'): ?>
                  <option value='libre'selected>Libre</option>
                  </select> 
              </div>
                <?php else : ?>
                  <option value='reservation'selected>Désolé salle déja réservé</option>
                </select> 
              </div>
                <?php endif; ?>
                
            <?php if (isset($_SESSION['auth'])): ?>
              <div class="mx-auto">
                <button type="submit" name="submit" class="btn btn-primary my-2">Réserver</button>
            </div>
         </form>
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
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="commentaire" rows="4"></textarea>
                </div>

                <div class="form-group my-4">
                  <label class="mr-sm-2" for="inlineFormCustomSelect3">Note :</label>
                  <select class="custom-select mr-sm-2" name="note" id="inlineFormCustomSelect3">
                    <option value="" selected>Note</option>
                    <option value='&#9733;'>&#9733;</option>
                    <option value='&#9733;&#9733;'>&#9733;&#9733;</option>
                    <option value='&#9733;&#9733;&#9733;'>&#9733;&#9733;&#9733;</option>
                    <option value='&#9733;&#9733;&#9733;&#9733;'>&#9733;&#9733;&#9733;&#9733;</option>
                    <option value='&#9733;&#9733;&#9733;&#9733;&#9733;'>&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                  </select> 
                </div>

              <div class="card-body">
                <p></p>
                <small class="text-muted"></small>
                <hr>
                <?php if (isset($_SESSION['auth'])): ?>
                  <button type="submit" name="send" class="btn btn-primary my-2">Poster votre avis</button>
                <?php else : ?>
                    <a href="login.php">Se connecter</a>
              <?php endif; ?>
              </div>
            </form>
          </div>  
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
  <!-- /.container -->
  <?php require_once "footer.php"; ?>