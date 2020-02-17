<?php

$bdd = new PDO('mysql:host=sql25;dbname=psn17421;charset=utf8', 'psn17421', 'Oij2lVle1zi');

$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); 

?>
