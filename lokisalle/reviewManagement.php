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

      header('Location: reviewManagement.php');
   }
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
                         ORDER BY a.id_avis ASC  
                         LIMIT 0,50');


?>


<div class="container">
    
    <h1>Gestion des commandes</h1>

    <table class="table table-responsive table-dark table-bordered table-sm text-center mt-4">
        <tr class="bg-danger">
            <th scope="col">id_avis</th>
            <th scope="col">id_membre</th>
            <th scope="col">id_salle</th>
            <th scope="col">commentaire</th>
            <th scope="col">note</th>
            <th scope="col">date_enregistrement</th>
            <th scope="col">actions</th>
        </tr>
         <?php while($a = $avis->fetch()) { ?>
         
        <tr>
            <td scope="col"><?= $a['avis_id'] ?></td>
            <td scope="col"><?= $a['a_membreid'] . ' -' . $a['emailm'] ?></td>
            <td scope="col"><?= $a['a_salleid'] . ' - ' . $a['stitre'] ?></td>
            <td scope="col"><?= $a['a_com']?></td>
            <td scope="col"><?= $a['ade']?></td>
            <td scope="col">
                <a href="reviewManagement.php?type=avis&supprime=<?= $a['avis_id'] ?>">Supprimer</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>

<?php require_once "footer.php"; ?>