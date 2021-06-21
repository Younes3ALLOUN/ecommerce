<?php
include_once '../connexion.php';

if (!isset($_SESSION)) {
    session_start();
}

//$articleid = htmlspecialchars($_POST['article_id']);
$currentuser = htmlspecialchars($_SESSION['id']);
//$qte = htmlspecialchars($_POST['quantity']);
$cartitems = $bdd->query('SELECT * FROM panier WHERE id_user = "' . $currentuser . '"');
$cart_all = $cartitems->fetchAll();
$cartproducts = array();
for ($i = 0; $i <= sizeof($cart_all) - 1; $i++) {
    $cartarticles = $bdd->query('SELECT * FROM products WHERE sku ="' . $cart_all[$i][0] . '"');
    array_push($cartproducts, $cartarticles->fetch());
}
//echo json_encode($cartproducts);
//$cartarticles = $bdd->query('SELECT * FROM products WHERE sku =?');

//echo json_encode($cart_all);
//echo json_encode($cartitems->fetch()['id_art']);
//echo $cartarticles;
