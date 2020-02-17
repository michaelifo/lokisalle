<?php 

require_once "functions.php"; 


require_once "header.php";

$bdd = new PDO('mysql:host=sql25;dbname=psn17421;charset=utf8', 'psn17421', 'B0hndYzwMTos');

$user_statut = $_SESSION['auth']->statut;


if ($user_statut != 1) {
   
   exit();
}

if (isset($_GET['type']) AND $_GET['type'] == 'commande') {
   
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      
      $supprime = (int) $_GET['supprime'];
      
      $req = $bdd->prepare('DELETE FROM commande WHERE id_commande = ?');
      
      $req->execute(array($supprime));

      header('Location: productManagement.php');
   }
}

$commandes = $bdd->query('SELECT commande.id_commande, 
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
                         ORDER BY commande.id_commande ASC  
                         LIMIT 0,50');


?>


<div class="container">
    
    <h1>Gestion des commandes</h1>

    <table class="table table-responsive table-dark table-bordered table-sm text-center mt-4">
        <tr class="bg-danger">
            <th scope="col">id_commande</th>
            <th scope="col">id_membre</th>
            <th scope="col">id_produit</th>
            <th scope="col">Prix</th>
            <th scope="col">date_enregistrement</th>
            <th scope="col">actions</th>
        </tr>
         <?php while($c = $commandes->fetch()) { ?>
         
        <tr>
            <td scope="col"><?= $c['id_commande'] ?></td>
            <td scope="col"><?= $c['id_membre'] . ' -' . $c['email'] ?></td>
            <td scope="col"><?= $c['id_produit'] . ' -' . $c['id_salle'] ?></td>
            <td scope="col"><?= $c['prix'] . '€' ?></td>
            <td scope="col"><?= $c['date_enregistrement']?></td>
            <td scope="col">
                <a href="commandeManagement.php?type=commande&supprime=<?= $c['id_commande'] ?>">Supprimer</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>

<?php require_once "footer.php"; ?>