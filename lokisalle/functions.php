<?php

function debug($variable) {

    echo '<pre>' . print_r($variable, true) . '</pre>';
}


function str_random($length) {

    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";

    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);

}

function logged_only() {

    if (session_status() == PHP_SESSION_NONE) {
        
        session_start();
    }

    if (!isset($_SESSION['auth'])) {

        $_SESSION['flash'] ['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
        
        header('location: login.php');
    
        exit();
    }
}

function reconnect_from_cookie() {

    if (session_status() == PHP_SESSION_NONE) {
        
        session_start();
    }

    if (isset($_COOKIE['remember']) && !isset($_SESSION['auth']) ){

        require_once 'db.php';

        if(!isset($bdd)) {

            global $bdd;
        }
    
        $remember_token = $_COOKIE['remember'];
        
        $parts = explode('==', $remember_token);
    
        $user_id = $parts[0];
    
        $req = $bdd->prepare('SELECT * FROM membre WHERE id_membre = ?');
    
        $req->execute([$user_id]);
    
        $user = $req->fetch();
    
        if($user) {
    
            $expected = $user_id. '==' . $user->remember_token . sha1($user_id . 'nekosan');
    
            if ($expected == $remember_token) {
                
                $_SESSION['auth'] = $user;

                setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);
    
            } else {

                setcookie('remember', null, -1);
            }
        } else {

            setcookie('remember', null, -1);
        }
    }
}



