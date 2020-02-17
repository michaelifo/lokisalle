<?php require_once "functions.php"; ?>

<?php require_once "header.php"; ?>

<?php 

require_once "db.php";

reconnect_from_cookie();

if(isset($_SESSION['auth'])) {

    header('Location: account.php');

    exit();
}

if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
    
    $req = $bdd->prepare('SELECT * FROM membre WHERE (pseudo = :username OR email = :username) AND confirmed_at IS NOT NULL');

    $req->execute(['username' => $_POST['username']]);

    $user = $req->fetch();

    if ($user == null) {
        
        $errors['username'] = "Identifiant ou mot de passe incorrect";

    } elseif (password_verify($_POST['password'], $user->mdp)) {

        $_SESSION['auth'] = $user;

        $_SESSION['flash']['success'] = "Vous êtes maintenant connecté";

        if ($_POST['remember']) {

            $remember_token = str_random(250);
            
            $bdd->prepare('UPDATE membre SET remember_token = ? WHERE id_membre = ?')->execute([$remember_token, $user->id_membre]);

            setcookie('remember', $user->id_membre. '==' . $remember_token . sha1($user->id_membre . 'nekosan'), time() + 60 * 60 * 24 * 7);
        }

        header('Location: account.php');

        exit();
        
    } else {
        
        $errors['password'] = "Identifiant ou mot de passe incorrect";

        
    }
    
}

?>



<div class="container">
    
    <h1 class="text-left">Connexion</h1>

    <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>  
        </ul>
    </div>
    <?php endif; ?> 

    <form method="POST" class="mt-4">

        <div class="form-group">
            <label for="">Pseudo ou email</label>
            <input type="text" name="username" class="form-control" >
        </div>

        <div class="form-group">
            <label for="">Mot de passe <a href="forget.php">(oubli de mot de passe?)</a></label>
            <input type="password" name="password" class="form-control" >
        </div>

        <div class="form-group">
                
                <label>
                    <input type="checkbox" name="remember" value="1"> Se souvenir de moi
                </label>

        </div>

        <button type="submit" name="submit" class="btn btn-primary">Se connecter</button>    
    </form>
</div>

<?php require_once "footer.php"; ?>


