<?php require_once "functions.php"; ?>

<?php require_once "header.php"; ?>

<?php 

require_once "db.php";


if(isset($_GET['id']) && isset($_GET['token'])){

    $req = $bdd->prepare('SELECT * FROM membre WHERE id_membre = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
    
    $req->execute([$_GET['id'], $_GET['token']]);
    
    $user = $req->fetch();
    
    if($user){
        if(!empty($_POST)){
    
            if(!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']){

                $user_id = $_GET['id'];
    
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
                $bdd->prepare('UPDATE membre SET mdp = ?, reset_at = NULL, reset_token = NULL WHERE id_membre = ? ')->execute([$password,$user_id]);
    
                $_SESSION['flash']['success'] = 'Votre mot de passe a bien été modifié';
    
                $_SESSION['auth'] = $user;
    
                header('Location: account.php');
    
                exit();
            }
        }
    }else{
    
        session_start();
    
        $_SESSION['flash']['danger'] = "Ce token n'est pas valide";
    
        header('Location: login.php');
    
        exit();
    }
}else{
   
    header('Location: login.php');
   
    exit();
}

?>



<div class="container">
    
    <h1 class="text-left">Réinitialiser votre mot de passe</h1>

    <form method="POST" class="mt-4">

        <div class="form-group">
            <label for="">Mot de passe</label>
            <input type="password" name="password" class="form-control" >
        </div>
        <div class="form-group">
            <label for="">Confirmation du mot de passe</label>
            <input type="password" name="password_confirm" class="form-control" >
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Réinitialiser votre mot de passe</button>    
    </form>
</div>

<?php require_once "footer.php"; ?>


