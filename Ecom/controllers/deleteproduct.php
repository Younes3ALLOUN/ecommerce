<?php
include_once '../connexion.php';

if (!isset($_SESSION)) {
    session_start();
}

$id = htmlspecialchars($_POST['article_id']);
$user = htmlspecialchars($_SESSION['id']);
$check = $bdd->query('SELECT * FROM panier WHERE id_user = "' . $user . '" AND id_art = "' . $id . '"');
if ($check->rowCount() > 0) {
    $ins = $bdd->prepare('DELETE FROM panier WHERE id_art =? AND id_user =?');
    $ins->execute(array($id, $user));
    $panier = $bdd->query('SELECT * FROM panier WHERE id_user=' . $_SESSION['id']);
    $cart = $panier->rowCount();
    //$msg = 'Ce produit a été retiré de votre panier !';
    echo '<div  style="background-color:blue" class="uk-alert-secondary">
    Ce produit a été retiré de votre panier !
      </div>';
    echo $msg, '|', $cart, '|', 'uk-alert-secondary';
} else {
    $msg = 'Ce produit/utilisateur n\'existe pas !';
    //echo $msg;
    //<div class="uk-alert-secondary">echo $msg;</div>
    echo '<div  style="background-color:black" class="uk-alert-secondary">
    Ce produit/utilisateur n\'existe pas !
      </div>';
}
