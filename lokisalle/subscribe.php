<?php

require_once "functions.php"; 

session_start();

require_once "db.php";

if(!empty($_POST)) {

    $male_status = 'unchecked';

    if (isset($_POST['submit'])) {

        $selected_radio = $_POST['sexe'];

        if ($selected_radio == 'homme') {

        $male_status = 'checked';

        }
        else if ($selected_radio == 'femme') {

        $female_status = 'checked';

        }

    }

    if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {

        $errors['username'] = "Votre pseudo n'est pas valide (alphanumerique) !";
    } else {
        $req = $bdd->prepare('SELECT id_membre FROM membre WHERE pseudo = ?');

        $req->execute([$_POST['username']]);

        $user = $req->fetch();

        if($user){
            $errors['username'] = "Ce pseudo est déjà pris !";
        } 
    }    

       

    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Votre email n'est pas valide";
    } else {
        $req = $bdd->prepare('SELECT id_membre FROM membre WHERE email = ?');

        $req->execute([$_POST['email']]);

        $user = $req->fetch();

        if($user) {
            $errors['email'] = "Cet email est déjà utilisé !";
        } 
    }    
  

    if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
        $errors['password'] = "Vous devez rentrer un mot de passe valide !";
    }

    if(empty($errors)) {

        $req = $bdd->prepare('INSERT INTO membre SET pseudo = ?, mdp = ?, nom=?, prenom=?, email= ?, civilite = ?, date_enregistrement= now(), confirmation_token = ?');

        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $token = str_random(60);

        $req->execute([$_POST['username'], $password, $_POST['name'], $_POST['surname'], $_POST['email'], $_POST['sexe'], $token]);

        $user_id = $bdd->lastInsertId();

        mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttps://lokisalle.kazamacorp.fr/confirm.php?id=$user_id&token=$token", 'From: postmaster@kazamacorp.fr');

        $_SESSION['flash']['success'] = "Un email de confirmation vous a été envoyé pour valider votre compte";

        header('location: login.php');

        exit();
    }

    
}




?>

<?php require_once "header.php"; ?>

<div class="container">
    
    <h2>Inscription</h2>

    <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <p>Vous n'avez pas rempli le formulaire correctement</p>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>  
        </ul>
    </div>
    <?php endif; ?>     

    <form method="POST" class="mt-4">
        
        <div class="form-group">
            <label for="">Homme</label>
            <input type="radio" name="sexe" class="form-check-inline" value='homme'>
            <label for="">Femme</label>
            <input type="radio" name="sexe" class="form-check-inline" value='femme' checked>   
        </div>

        <div class="form-group">
            <label for="">Nom</label>
            <input type="text" name="name" class="form-control" >
        </div>

        <div class="form-group">
            <label for="">Prenom</label>
            <input type="text" name="surname" class="form-control" >
        </div>

        <div class="form-group">
            <label for="">Pseudo</label>
            <input type="text" name="username" class="form-control" >
        </div>

        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control" >
        </div>

        <div class="form-group">
            <label for="">Mot de passe</label>
            <input type="password" name="password" class="form-control" >
        </div>

        <div class="form-group">
            <label for="">Confirmez votre mot de passe</label>
            <input type="password" name="password_confirm" class="form-control" >
        </div>

        <button type="submit" name="submit" class="btn btn-primary">M'inscrire</button>    
    </form>
   
</div>

<?php require_once "footer.php"; ?>