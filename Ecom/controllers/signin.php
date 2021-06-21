<?php
include_once '../connexion.php';

$nom = htmlspecialchars(ucfirst($_POST['nom']));
$prenom = htmlspecialchars(ucfirst($_POST['prenom']));
$email = htmlspecialchars($_POST['email']);
$pass = htmlspecialchars(sha1($_POST['pass']));
$pass1 = htmlspecialchars(sha1($_POST['pass1']));
if ($pass === $pass1) {
    $check = $bdd->query('SELECT * FROM users WHERE email = "' . $email . '"');
    if ($check->rowCount() > 0) echo $msg = "<div class='uk-alert uk-width-1 uk-alert-danger uk-animation-slide-top-small'>Sorry this email is already in use!</div>";
    else {
        $insert = $bdd->prepare('INSERT INTO users(email,name,lastname,password) VALUES(?,?,?,?)');
        $insert->execute(array($email, $prenom, $nom, $pass));
        $msg = "<div class='uk-alert uk-width-1 uk-alert-success uk-animation-slide-top-small'>You were signed in successfuly!   <div uk-spinner>Redirecting....</div></div>";
        echo $msg, 'SUCESSSIGNIN';
    }
} else {
    $msg = "<div class='uk-alert uk-width-1-2@s uk-alert-danger uk-animation-slide-top-small'>The passwords don't match!</div>";
    echo $msg;
}
