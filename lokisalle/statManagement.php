<?php 

require_once "functions.php"; 


require_once "header.php";

require_once "db_second.php";

$user_statut = $_SESSION['auth']->statut;


if ($user_statut != 1) {
   
   exit();
}


$stats = $bdd->query('SELECT c.id_commande AS commande_id,
                             c.id_membre AS c_membreid,
                             c.id_produit AS c_produitid,
                             m.id_membre AS membre_id,
                             a.id_avis AS avis_id,
                             a.id_membre AS a_membreid,
                             a.id_salle AS a_salleid,
                             a.note AS note_a,
                             p.id_produit AS produit_id,
                             p.prix AS prix,
                             p.id_salle as p_salleid,
                             s.id_salle AS salleid,
                             s.titre AS s_titre            
                     FROM commande AS c
                     LEFT JOIN membre AS m
                     ON c.id_membre = m.id_membre
                     RIGHT JOIN avis AS a
                     ON m.id_membre = a.id_membre
                     RIGHT JOIN produit AS p
                     ON c.id_produit = p.id_produit
                     RIGHT JOIN salle AS s
                     ON p.id_salle = s.id_salle 
                     ORDER BY c.id_commande ASC  
                     LIMIT 0,50');



$stats->setFetchMode(PDO::FETCH_ASSOC); 

?>


<div class="container">
    
    <h1>Statistiques</h1>

    <table class="table table-dark table-bordered text-center mt-4">
        <tr class="bg-danger">
            <th scope="col">Top 5 - salles mieux notés</th>
            <th scope="col">Top 5 - salles plus commandées</th>
            <th scope="col">Top 5 - membres qui achètent le plus (en termes de quantité).</th>
            <th scope="col">Top 5 - membres qui achètent le plus cher (en termes de prix)</th>
            <th scope="col">actions</th>
        </tr>
         <?php foreach($stats as $stat) { ?>
         
        <tr>
            <td scope="col"><?=$stat['commande_id'] . ' -' .  ' salle ' . $stat['s_titre'] . ' ' . $stat['salleid'] ?></td>
            <td scope="col"><?=$stat['commande_id'] . ' -' .  ' salle ' . $stat['s_titre'] . ' ' . $stat['salleid'] ?></td>
            <td scope="col"><?=$stat['commande_id'] . ' -' .  ' salle ' . $stat['s_titre'] . ' ' . $stat['salleid'] ?></td>
            <td scope="col"><?=$stat['commande_id'] . ' -' .  ' salle ' . $stat['s_titre'] . ' ' . $stat['salleid'] ?></td> 
            <td scope="col">
                <a href="statManagement.php?type=avis&supprime=<?= $stat['avis_id'] ?>">Supprimer</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>

<?php require_once "footer.php"; ?>