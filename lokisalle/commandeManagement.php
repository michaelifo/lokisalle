<?php 

require_once "functions.php"; 


require_once "header.php";

require_once "db_second.php";

$user_statut = $_SESSION['auth']->statut;


if ($user_statut != 1) {
   
   exit();
}

if (isset($_GET['type']) AND $_GET['type'] == 'commande') {
   
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      
      $supprime = (int) $_GET['supprime'];
      
      $req = $bdd->prepare('DELETE FROM commande WHERE id_commande = ?');
      
      $req->execute(array($supprime));

      header('Location: commandeManagement.php');
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
                         GROUP BY c.id_commande,
                                  c.id_membre, 
                                  c.id_produit, 
                                  c.date_enregistrement 
                         ORDER BY c.id_commande DESC  
                         LIMIT 0,50');

$commandes->setFetchMode(PDO::FETCH_ASSOC);                         

?>


<div class="container">
    
    <h1>Gestion des commandes</h1>

    <table class="table table-dark table-bordered table-sm text-center mt-4">
        <tr class="bg-danger">
            <th scope="col">id_commande</th>
            <th scope="col">id_membre</th>
            <th scope="col">id_produit</th>
            <th scope="col">Prix</th>
            <th scope="col">date_enregistrement</th>
            <th scope="col">actions</th>
        </tr>
         <?php foreach($commandes as $c) { ?>
         
        <tr>
            <td scope="col"><?= $c['commandeid'] ?></td>
            <td scope="col"><?= $c['cmembreid'] . ' -' . $c['emailm'] ?></td>
            <td scope="col"><?= $c['cproduitid'] . ' - ' . $c['stitre'] . '<br>' . $c['pda'] . ' au ' . $c['pdd'] ?></td>
            <td scope="col"><?= $c['pprix'] . '€' ?></td>
            <td scope="col"><?= $c['cde']?></td>
            <td scope="col">
                <a href="commandeManagement.php?type=commande&supprime=<?= $c['commandeid'] ?>">Supprimer</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>

<?php require_once "footer.php"; ?>