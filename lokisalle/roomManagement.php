<?php 

require_once "functions.php"; 


require_once "header.php";

$bdd = new PDO('mysql:host=sql25;dbname=psn17421;charset=utf8', 'psn17421', 'B0hndYzwMTos');

$user_statut = $_SESSION['auth']->statut;


if ($user_statut != 1) {
   
   exit();
}

if (isset($_GET['type']) AND $_GET['type'] == 'room') {

   if(isset($_GET['ajouter']) AND !empty($_GET['ajouter'])) {

      
         if ($_POST){
            
            $req = $bdd->prepare('INSERT INTO salle SET titre = ?, description = ?, photo = ?, pays = ?, ville = ?, adresse = ?, cp = ?, capacite = ?, categorie = ?');

            $req->execute([$_POST['title'], $_POST['description'], $_POST['picture'], $_POST['pays'], $_POST['ville'], $_POST['adresse'], $_POST['cp'], $_POST['capacite'],$_POST['categorie']]);

            header('Location: roomManagement.php');
         }   
      
	}

   if(isset($_GET['editer']) AND !empty($_GET['editer'])) {

      if($_POST) {

         $edit = (int) $_GET['editer'];

         if($_POST['title']) {
         
            $req = $bdd->prepare('SELECT id_salle FROM salle WHERE titre = ?');

            $req->execute([$_POST['title']]);

            $title = $_POST['title'];

            $req = $bdd->prepare('UPDATE salle SET titre = ? WHERE id_salle = ?')->execute([$title, $edit]);

         }   

         if ($_POST['description']) {

            $req = $bdd->prepare('SELECT id_salle FROM salle WHERE description = ?');

            $req->execute([ $_POST['description']]);

            $description = $_POST['description'];

            $req = $bdd->prepare('UPDATE salle SET description = ?  WHERE id_salle = ?')->execute([$description, $edit]);

         }

         if ($_POST['picture']) {

            $req = $bdd->prepare('SELECT id_salle FROM salle WHERE photo = ?');

            $req->execute([ $_POST['picture']]);

            $picture = $_POST['picture'];

            $req = $bdd->prepare('UPDATE salle SET photo = ?  WHERE id_salle = ?')->execute([$picture, $edit]);

         }

         if ($_POST['pays']) {

            $req = $bdd->prepare('SELECT id_salle FROM salle WHERE pays = ?');

            $req->execute([ $_POST['pays']]);

            $pays = $_POST['pays'];

            $req = $bdd->prepare('UPDATE salle SET pays = ?  WHERE id_salle = ?')->execute([$pays, $edit]);

         }

         if ($_POST['ville']) {

            $req = $bdd->prepare('SELECT id_salle FROM salle WHERE ville = ?');

            $req->execute([ $_POST['ville']]);

            $ville = $_POST['ville'];

            $req = $bdd->prepare('UPDATE salle SET ville = ?  WHERE id_salle = ?')->execute([$ville, $edit]);

         }

         if ($_POST['adresse']) {

            $req = $bdd->prepare('SELECT id_salle FROM salle WHERE adresse = ?');

            $req->execute([ $_POST['adresse']]);

            $adresse = $_POST['adresse'];

            $req = $bdd->prepare('UPDATE salle SET adresse = ?  WHERE id_salle = ?')->execute([$adresse, $edit]);

         }

         if ($_POST['cp']) {

            $req = $bdd->prepare('SELECT id_salle FROM salle WHERE cp = ?');

            $req->execute([ $_POST['cp']]);

            $cp = $_POST['cp'];

            $req = $bdd->prepare('UPDATE salle SET cp = ?  WHERE id_salle = ?')->execute([$cp, $edit]);

         }
         if ($_POST['capacite']) {

            $req = $bdd->prepare('SELECT id_salle FROM salle WHERE capacite = ?');

            $req->execute([ $_POST['capacite']]);

            $capacite = $_POST['capacite'];

            $req = $bdd->prepare('UPDATE salle SET capacite = ?  WHERE id_salle = ?')->execute([$capacite, $edit]);

         }
         if ($_POST['categorie']) {

            $req = $bdd->prepare('SELECT id_salle FROM salle WHERE categorie = ?');

            $req->execute([ $_POST['categorie']]);

            $categorie = $_POST['categorie'];

            $req = $bdd->prepare('UPDATE salle SET categorie = ?  WHERE id_salle = ?')->execute([$categorie, $edit]);

         }

         header('Location: roomManagement.php');
      }
	}
   
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      
      $supprime = (int) $_GET['supprime'];
      
      $req = $bdd->prepare('DELETE FROM salle WHERE id_salle = ?');
      
      $req->execute(array($supprime));

      header('Location: roomManagement.php');
   }
}

$rooms = $bdd->query('SELECT * FROM salle ORDER BY id_salle ASC LIMIT 0,20');

?>

<div class="container">
    
    <h1>Gestion des salles</h1>

      <table class="table table-dark table-bordered text-center mt-4">
         <tr>
            <th scope="col">id_salle</th>
            <th scope="col">titre</th>
            <th scope="col">description</th>
            <th scope="col">photo</th>
            <th scope="col">pays</th>
            <th scope="col">ville</th>
            <th scope="col">adresse</th>
            <th scope="col">cp</th>
            <th scope="col">capacite</th>
            <th scope="col">categorie</th>
            <th scope="col">actions</th>
         </tr>
         <?php while($r = $rooms->fetch()) { ?>
            <tr>
               <td scope="col"><?= $r['id_salle'] ?></td>
               <td scope="col"><?= $r['titre'] ?></td>
               <td scope="col"><?= $r['description'] ?></td>
               <td scope="col"><?='<img src="images/' . $r['photo']. '"' .  'alt="salle de reunion"' . 'class="img-fluid">' ?></td>
               <td scope="col"><?= $r['pays'] ?></td>
               <td scope="col"><?= $r['ville'] ?></td>
               <td scope="col"><?= $r['adresse'] ?></td>
               <td scope="col"><?= $r['cp'] ?></td>
               <td scope="col"><?= $r['capacite'] ?></td>
               <td scope="col"><?= $r['categorie'] ?></td>
               <td scope="col">
                    <a href="roomManagement.php?type=room&ajouter=<?= $r['id_salle'] ?>">Ajouter</a><br>
                    <a href="roomManagement.php?type=room&editer=<?= $r['id_salle'] ?>">Editer</a><br>
                    <a href="roomManagement.php?type=room&supprime=<?= $r['id_salle'] ?>">Supprimer</a>
               </td>
            </tr>
         <?php } ?>
      </table>

      <?php if (isset($_GET['editer']) || isset($_GET['ajouter'])) : ?>      
      <form action="" method="POST" class="mt-4">

         <div class="form-group">
            <label for="">Titre</label>
            <input class="form-control" type="text" name="title" placeholder="Titre de la salle">
         </div>

         <div class="form-group">
            <label for="">Description</label>
            <input class="form-control" type="text" name="description" placeholder="Description de la salle">
         </div>
         
         <div class="form-group">
            <label for="">Photo</label>
            <input class="form-control" type="file"
                   id="picture" name="picture"
                   accept="image/*">
         </div>
        
         <div class="form-group my-4">
            <label class="mr-sm-2" for="inlineFormCustomSelect">Pays</label>
            <select class="custom-select mr-sm-2" name="pays" id="inlineFormCustomSelect">
               <option value="" selected>Pays</option>
               <option value="france">France</option>
            </select>   
         </div>
   
         <div class="form-group my-4">
            <label class="mr-sm-2" for="inlineFormCustomSelect2">Villes</label>
            <select class="custom-select mr-sm-2" name="ville" id="inlineFormCustomSelect2">
               <option value="" selected>Villes</option>
               <option value='Paris'>Paris</option>
               <option value='Lyon'>Lyon</option>
               <option value='Marseille'>Marseille</option>
            </select>   
         </div>

         <div class="form-group my-4">
            <label for="exampleFormControlTextarea1">Adresse</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="adresse" rows="3"></textarea>
         </div>

         <div class="form-group my-4">
            <label for="exampleFormControlTextarea2">Code Postal</label>
            <textarea class="form-control" id="exampleFormControlTextarea2" name="cp" rows="1"></textarea>
         </div>

         <div class="form-group my-4">
            <label class="mr-sm-2" for="inlineFormCustomSelect3">Capacite</label>
            <select class="custom-select mr-sm-2" name="capacite" id="inlineFormCustomSelect3">
               <option value="" selected>Capacités</option>
               <option value='1'>1</option>
               <option value='2'>2</option>
               <option value='3'>3</option>
               <option value='4'>4</option>
               <option value='5'>5</option>
               <option value='6'>6</option>
               <option value='7'>7</option>
               <option value='8'>8</option>
               <option value='9'>9</option>
               <option value='10'>10</option>
               <option value='11'>11</option>
               <option value='12'>12</option>
               <option value='13'>13</option>
               <option value='14'>14</option>
               <option value='15'>15</option>
               <option value='16'>16</option>
               <option value='17'>17</option>
               <option value='18'>18</option>
               <option value='19'>19</option>
               <option value='20'>20</option>
               <option value='21'>21</option>
               <option value='22'>22</option>
               <option value='23'>23</option>
               <option value='24'>24</option>
               <option value='25'>25</option>
               <option value='26'>26</option>
               <option value='27'>27</option>
               <option value='28'>28</option>
               <option value='29'>29</option>
               <option value='30'>30</option>
               <option value="31">31</option>
               <option value="32">32</option>
               <option value="32">33</option>
               <option value="33">33</option>
               <option value="34">34</option>
               <option value="35">35</option>
               <option value="36">36</option>
               <option value="37">37</option>
               <option value="38">38</option>
               <option value="39">39</option>
               <option value="40">40</option>
               <option value="41">41</option>
               <option value="42">42</option>
               <option value="43">43</option>
               <option value="44">44</option>
               <option value="45">45</option>
               <option value="46">46</option>
               <option value="47">47</option>
               <option value="48">48</option>
               <option value="49">49</option>
               <option value="50">50</option>
            </select> 
         </div>

         <div class="form-group my-4">
            <label class="mr-sm-2" for="inlineFormCustomSelect4">Categorie</label>
            <select class="custom-select mr-sm-2" name="categorie" id="inlineFormCustomSelect4">
               <option value="" selected>Categorie</option>
               <option value='réunion'>Réunion</option>
               <option value='bureau'>Bureau</option>
               <option value='formation'>Formation</option>
            </select>   
         </div>

        <button class="btn btn-primary mb-4" name="submit">Enregistrer</button>
    </form>
    <?php else : ?>
   <?php endif; ?> 
</div>

<?php require_once "footer.php"; ?>