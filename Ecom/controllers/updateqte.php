<?php
include_once '../connexion.php';

if (!isset($_SESSION)) {
    session_start();
}

$id = htmlspecialchars($_POST['article_id']);
$user = htmlspecialchars($_SESSION['id']);
$qte = htmlspecialchars($_POST['quantity']);
$check = $bdd->query('SELECT * FROM panier WHERE id_user = "' . $user . '" AND id_art = "' . $id . '"');
if ($check->rowCount() > 0) {
    if ($_POST['quantity'] <= 0) {
        $msg = 'Please enter a valid quantity number!';
        echo $msg, '|', 'uk-alert-danger';
    } else {
        $ins = $bdd->prepare('UPDATE panier SET qte=? WHERE id_art =? AND id_user =?');
        $ins->execute(array($qte, $id, $user));
        $msg = 'This product\'s quantity has been updated!';
        echo $msg, '|', 'uk-alert-success';
    }
} else {
    $msg = 'This product/user doesn\'t exist!';
    echo $msg, '|', 'uk-alert-danger';
}
