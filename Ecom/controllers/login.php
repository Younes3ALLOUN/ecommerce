<?php
include_once '../connexion.php';

$email = htmlspecialchars($_POST['email']);

$pass = htmlspecialchars(sha1($_POST['pass']));
$check = $bdd->query('SELECT * FROM users WHERE email ="' . $email . '" AND password = "' . $pass . '"');
if ($check->rowCount() > 0) {
    $user = $check->fetch();
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = explode('@', $user['email'])[0];
} else {
    $msg1 = '<div class="uk-alert uk-width-1-2@s uk-alert-danger uk-animation-slide-top-small">This user doesn\'t exist!</div>';
    echo $msg1;
}
