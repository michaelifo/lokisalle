<?php 

require_once "functions.php";

logged_only();

require "db.php";

if (!empty($_POST)) {

    if(empty($_POST['name']) || !preg_match('/[a-zA-Z]/', $_POST['name'])) {

        $_SESSION['flash']['danger'] .= "Veuillez rentrer un nom valide ! <br>";

    } else {

        $user_id = $_SESSION['auth']->id_membre;

        $name = $_POST['name'];

        $bdd->prepare('UPDATE membre SET nom = ? WHERE id_membre = ?')->execute([$name,$user_id]);

        $_SESSION['flash']['success'] .= "Votre nom a bien été modifié ! <br>";

        $_SESSION['auth']->nom = $name;
        }

    if(empty($_POST['surname']) || !preg_match('/[a-zA-Z]/', $_POST['surname'])) {

        $_SESSION['flash']['danger'] .="Veuillez rentrer un prénom valide ! <br>";
    } else {

        $user_id = $_SESSION['auth']->id_membre;

        $surname = $_POST['surname'];

        $bdd->prepare('UPDATE membre SET prenom = ? WHERE id_membre = ?')->execute([$surname,$user_id]);

        $_SESSION['flash']['success'] .= "Votre prenom a bien été modifié ! <br>";

        $_SESSION['auth']->prenom = $surname;
        }

    if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {

        $_SESSION['flash']['danger'] .="Veuillez rentrer un pseudo valide ! <br>";
    } else {
        $req = $bdd->prepare('SELECT id_membre FROM membre WHERE pseudo = ?');

        $req->execute([$_POST['username']]);

        $user = $req->fetch();

        if($user){
            $_SESSION['flash']['danger'] .= "Votre pseudo est déja utilisé ! <br>";
        } else {

            $user_id = $_SESSION['auth']->id_membre;

            $username = $_POST['username'];

            $bdd->prepare('UPDATE membre SET pseudo = ? WHERE id_membre = ?')->execute([$username,$user_id]);

            $_SESSION['flash']['success'] .= "Votre pseudo a bien été modifié ! <br>";

            $_SESSION['auth']->pseudo = $username;
        }
    }    
        

    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        $_SESSION['flash']['danger'] .= "Votre email n'est pas valide ! <br>";
    } else {

        $req = $bdd->prepare('SELECT id_membre FROM membre WHERE email = ?');

        $req->execute([$_POST['email']]);

        $user = $req->fetch();

        if($user) {

            $_SESSION['flash']['danger'] .= "Votre email est déja utilisé ! <br>";
        } else {

            $user_id = $_SESSION['auth']->id_membre;

            $mail = $_POST['email'];

            $bdd->prepare('UPDATE membre SET email = ? WHERE id_membre = ?')->execute([$mail,$user_id]);

            $_SESSION['flash']['success'] .= "Votre email a bien été modifié ! <br>";

            $_SESSION['auth']->email = $mail;
        }
        
    }        
        
    
    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {

        $_SESSION['flash']['danger'] .= "Les mots de passes ne correspondent pas ! <br>";
    } else {

        $user_id = $_SESSION['auth']->id_membre;

        $password= password_hash($_POST['password'], PASSWORD_BCRYPT);

        $bdd->prepare('UPDATE membre SET mdp = ? WHERE id_membre = ?')->execute([$password,$user_id]);

        $_SESSION['flash']['success'] .= "Votre mot de passe a bien été modifier ! <br>";

        $_SESSION['auth']->mdp = $password;
        }
    
        header('location: account.php');

        exit();
      
}

?>

<?php require_once "header.php"; ?>

<div class="container text-center">

    <h2>Edition du profil</h2>

    <form action="" method="POST" class="mt-4">

        <div class="form-group">
            <input class="form-control" type="text" name="name" placeholder="Changer de nom">
        </div>
        <div class="form-group">
            <input class="form-control" type="text" name="surname" placeholder="Changer de prenom">
        </div>
        <div class="form-group">
            <input class="form-control" type="text" name="username" placeholder="Changer de pseudo">
        </div>
        <div class="form-group">
            <input class="form-control" type="email" name="email" placeholder="Changer de mail">
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Changer de mot de passe">
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="password_confirm" placeholder="Confirmation du mot de passe">
        </div>
        <button class="btn btn-primary">Effectuer les changements</button>
    </form>
</div>

<?php require_once "footer.php"; ?>
