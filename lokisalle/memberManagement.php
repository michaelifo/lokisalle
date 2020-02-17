<?php 

require_once "functions.php"; 


require_once "header.php";

$bdd = new PDO('mysql:host=sql25;dbname=psn17421;charset=utf8', 'psn17421', 'B0hndYzwMTos');

$user_statut = $_SESSION['auth']->statut;


if ($user_statut != 1) {
   
   exit();
}

if (isset($_GET['type']) AND $_GET['type'] == 'membre') {

   if(isset($_GET['editer']) AND !empty($_GET['editer'])) {

      if($_POST) {

         $edit = (int) $_GET['editer'];

         if($_POST['username']) {
         
            $req = $bdd->prepare('SELECT id_membre FROM membre WHERE pseudo = ?');

            $req->execute([$_POST['username']]);

            $username = $_POST['username'];

            $req = $bdd->prepare('UPDATE membre SET pseudo = ? WHERE id_membre = ?')->execute([$username, $edit]);

         }   

         if ($_POST['name']) {

            $req = $bdd->prepare('SELECT id_membre FROM membre WHERE nom = ?');

            $req->execute([ $_POST['name']]);

            $name = $_POST['name'];

            $req = $bdd->prepare('UPDATE membre SET nom = ?  WHERE id_membre = ?')->execute([$name, $edit]);

         }

         if ($_POST['surname']) {

            $req = $bdd->prepare('SELECT id_membre FROM membre WHERE prenom = ?');

            $req->execute([ $_POST['surname']]);

            $surname = $_POST['surname'];

            $req = $bdd->prepare('UPDATE membre SET prenom = ?  WHERE id_membre = ?')->execute([$surname, $edit]);

         }

         if ($_POST['email']) {

            $req = $bdd->prepare('SELECT id_membre FROM membre WHERE email = ?');

            $req->execute([ $_POST['email']]);

            $email = $_POST['email'];

            $req = $bdd->prepare('UPDATE membre SET email = ?  WHERE id_membre = ?')->execute([$email, $edit]);

         }

         if ($_POST['sexe']) {

            $req = $bdd->prepare('SELECT id_membre FROM membre WHERE civilite = ?');

            $req->execute([ $_POST['sexe']]);

            $sexe = $_POST['sexe'];

            $req = $bdd->prepare('UPDATE membre SET civilite = ?  WHERE id_membre = ?')->execute([$sexe, $edit]);

         }

         if ($_POST['statut']) {

            $req = $bdd->prepare('SELECT id_membre FROM membre WHERE statut = ?');

            $req->execute([ $_POST['statut']]);

            $statut = $_POST['statut'];

            $req = $bdd->prepare('UPDATE membre SET statut = ?  WHERE id_membre = ?')->execute([$statut, $edit]);

         }

         header('Location: memberManagement.php');
      }
	}
   
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      
      $supprime = (int) $_GET['supprime'];
      
      $req = $bdd->prepare('DELETE FROM membre WHERE id_membre = ?');
      
      $req->execute(array($supprime));

      header('Location: memberManagement.php');
   }

}

$membres = $bdd->query('SELECT * FROM membre ORDER BY id_membre ASC LIMIT 0,20');

?>

<div class="container">
    
    <h1>Gestion des membres</h1>

      <table class="table table-dark table-bordered text-center mt-4">
         <tr>
            <th scope="col">id_membre</th>
            <th scope="col">pseudo</th>
            <th scope="col">nom</th>
            <th scope="col">prenom</th>
            <th scope="col">email</th>
            <th scope="col">civilite</th>
            <th scope="col">statut</th>
            <th scope="col">actions</th>
         </tr>
         <?php while($m = $membres->fetch()) { ?>
            <tr>
               <td scope="col"><?= $m['id_membre'] ?></td>
               <td scope="col"><?= $m['pseudo'] ?></td>
               <td scope="col"><?= $m['nom'] ?></td>
               <td scope="col"><?= $m['prenom'] ?></td>
               <td scope="col"><?= $m['email'] ?></td>
               <td scope="col"><?= $m['civilite'] ?></td>
               <td scope="col"><?= $m['statut'] ?></td>
               <td scope="col">
                  <a href="memberManagement.php?type=membre&editer=<?= $m['id_membre'] ?>">Editer</a><br>
                  <a href="memberManagement.php?type=membre&supprime=<?= $m['id_membre'] ?>">Supprimer</a>
               </td>
            </tr>
         <?php } ?>
      </table>

      <?php if (isset($_GET['editer'])) : ?>      
      <form action="" method="POST" class="mt-4">

         <div class="form-group">
            <label for="">Pseudo</label>
            <input class="form-control" type="text" name="username" placeholder="Changer de pseudo">
         </div>

         <div class="form-group">
            <label for="">Nom</label>
            <input class="form-control" type="text" name="name" placeholder="Changer de nom">
         </div>
         
         <div class="form-group">
            <label for="">Prenom</label>
            <input class="form-control" type="text" name="surname" placeholder="Changer de prenom">
         </div>
        
         <div class="form-group">
            <label for="">Email</label>
            <input class="form-control" type="email" name="email" placeholder="Changer de mail">
         </div>
   
         <div class="form-group my-1">
            <label class="mr-sm-2" for="inlineFormCustomSelect">Civilite</label>
            <select class="custom-select mr-sm-2" name="sexe" id="inlineFormCustomSelect">
               <option value="" selected>Genre</option>
               <option value='homme'>Homme</option>
               <option value='femme'>Femme</option>
            </select>   
         </div>

         <div class="form-group my-4">
            <label class="mr-sm-2" for="inlineFormCustomSelect2">Statut</label>
            <select class="custom-select mr-sm-2" name="statut" id="inlineFormCustomSelect2">
               <option value="" selected>Statut</option>
               <option value="2">Membre</option>
               <option value="1">Admin</option>
            </select>
         </div>
        <button class="btn btn-primary mb-4" name="submit">Enregistrer</button>
    </form>
    <?php else : ?>
   <?php endif; ?>
  
</div>

<?php require_once "footer.php"; ?>