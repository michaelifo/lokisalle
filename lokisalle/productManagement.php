<?php 

require_once "functions.php"; 


require_once "header.php";

$bdd = new PDO('mysql:host=sql25;dbname=psn17421;charset=utf8', 'psn17421', 'B0hndYzwMTos');

$user_statut = $_SESSION['auth']->statut;


if ($user_statut != 1) {
   
   exit();
}

if (isset($_GET['type']) AND $_GET['type'] == 'product') {

   if(isset($_GET['ajouter']) AND !empty($_GET['ajouter'])) {

      
         if ($_POST){
            
            $req = $bdd->prepare('INSERT INTO produit SET id_salle = ?, date_arrivee = ?, date_depart = ?, prix = ?, etat = ?');

            $req->execute([$_POST['room'], $_POST['date_arrivee'], $_POST['date_depart'], $_POST['prix'], $_POST['etat']]);

            header('Location: productManagement.php');
         }   
      
	}

   if(isset($_GET['editer']) AND !empty($_GET['editer'])) {

      if($_POST) {

         $edit = (int) $_GET['editer'];

         if($_POST['room']) {
         
            $req = $bdd->prepare('SELECT id_produit FROM produit WHERE id_salle = ?');

            $req->execute([$_POST['room']]);

            $room = $_POST['room'];

            $req = $bdd->prepare('UPDATE produit SET id_salle = ? WHERE id_produit = ?')->execute([$room, $edit]);

         }   

         if ($_POST['date_arrivee']) {

            $req = $bdd->prepare('SELECT id_produit FROM produit WHERE date_arrivee = ?');

            $req->execute([ $_POST['date_arrivee']]);

            $date_arrivee = $_POST['date_arrivee'];

            $req = $bdd->prepare('UPDATE produit SET date_arrivee = ?  WHERE id_produit = ?')->execute([$date_arrivee, $edit]);

         }

         if ($_POST['date_depart']) {

            $req = $bdd->prepare('SELECT id_produit FROM produit WHERE date_depart = ?');

            $req->execute([ $_POST['date_depart']]);

            $date_depart = $_POST['date_depart'];

            $req = $bdd->prepare('UPDATE produit SET date_depart = ?  WHERE id_produit = ?')->execute([$date_depart, $edit]);

         }

         if ($_POST['prix']) {

            $req = $bdd->prepare('SELECT id_produit FROM produit WHERE prix = ?');

            $req->execute([ $_POST['prix']]);

            $prix = $_POST['prix'];

            $req = $bdd->prepare('UPDATE produit SET prix = ?  WHERE id_produit = ?')->execute([$prix, $edit]);

         }

         if ($_POST['etat']) {

            $req = $bdd->prepare('SELECT id_produit FROM produit WHERE etat = ?');

            $req->execute([ $_POST['etat']]);

            $etat = $_POST['etat'];

            $req = $bdd->prepare('UPDATE produit SET etat = ?  WHERE id_produit = ?')->execute([$etat, $edit]);

         }

         header('Location: productManagement.php');
      }
	}
   
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      
      $supprime = (int) $_GET['supprime'];
      
      $req = $bdd->prepare('DELETE FROM produit WHERE id_produit = ?');
      
      $req->execute(array($supprime));

      header('Location: productManagement.php');
   }
}

$products = $bdd->query('SELECT produit.id_produit, 
                                produit.id_salle,
                                date_arrivee,
                                date_depart,
                                prix,
                                etat,
                                salle.id_salle,
                                salle.titre,
                                salle.photo,
                                salle.pays,
                                salle.ville,
                                salle.adresse,
                                salle.cp,
                                salle.capacite,
                                salle.categorie
                         FROM produit
                         LEFT JOIN salle 
                         ON produit.id_salle = salle.id_salle
                         ORDER BY produit.id_produit ASC  
                         LIMIT 0,30');


?>


<div class="container">
    
    <h1>Gestion des produits</h1>

      <table class="table table-responsive table-dark table-bordered text-center mt-4">
         <tr class="bg-danger">
            <th scope="col">id_produit</th>
            <th scope="col">id_salle</th>
            <th scope="col">date_arrivee</th>
            <th scope="col">date_depart</th>
            <th scope="col">prix</th>
            <th scope="col">etat</th>
            <th scope="col">actions</th>
         </tr>
         <?php while($p = $products->fetch()) { ?>
         
            <tr>
               <td scope="col"><?= $p['id_produit'] ?></td>
               <td scope="col"><?= $p['id_salle']. ' -' . ' salle ' . $p['titre'] .'<img src="images/' . $p['photo']. '"' .  'alt="salle de reunion"' . 'class="img-fluid">' ?></td>
               <td scope="col"><?= $p['date_arrivee'] ?></td>
               <td scope="col"><?= $p['date_depart'] ?></td>
               <td scope="col"><?= $p['prix'] . '€' ?></td>
               <td scope="col"><?= $p['etat'] ?></td>
               <td scope="col">
                    <a href="productManagement.php?type=product&ajouter=<?= $p['id_produit'] ?>">Ajouter</a><br>
                    <a href="productManagement.php?type=product&editer=<?= $p['id_produit'] ?>">Editer</a><br>
                    <a href="productManagement.php?type=product&supprime=<?= $p['id_produit'] ?>">Supprimer</a>
               </td>
            </tr>
         <?php } ?>
      </table>

      <?php if (isset($_GET['editer']) || isset($_GET['ajouter'])) : ?>      
      <form action="" method="POST" class="mt-4">
         
         <div class="form-group my-4">
            <label class="mr-sm-2" for="inlineFormCustomSelect">Salle</label>
            <select class="custom-select mr-sm-2" name="room" id="inlineFormCustomSelect">
               <option value="" selected>Salles</option>
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

         <div class="form-group">
            <label for="">Date d'arrivée</label>
            <input class="form-control" type="datetime-local" name="date_arrivee">
         </div>
         <div class="form-group">
            <label for="">Date de départ</label>
            <input class="form-control" type="datetime-local" name="date_depart">
         </div>

         <div class="form-group my-4">
            <label for="exampleFormControlTextarea">Tarif</label>
            <textarea class="form-control" id="exampleFormControlTextarea" name="prix" rows="2"></textarea>
         </div>

         <div class="form-group my-4">
            <label class="mr-sm-2" for="inlineFormCustomSelect2">État</label>
            <select class="custom-select mr-sm-2" name="etat" id="inlineFormCustomSelect2">
               <option value="" selected>État</option>
               <option value='libre'>Libre</option>
               <option value='reservation'>Réservation</option>
            </select>
               
         </div>

        <button class="btn btn-primary mb-4" name="submit">Enregistrer</button>
    </form>
    <?php else : ?>
   <?php endif; ?> 
</div>

<?php require_once "footer.php"; ?>