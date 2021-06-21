<?php
if (isset($_SESSION['id'])) {
    $panier = $bdd->query('SELECT * FROM panier WHERE id_user=' . $_SESSION['id']);
    $cart = $panier->rowCount();
}
?>

<nav class="uk-margin-bottom uk-light uk-background-primary" uk-navbar="mode: click" data-uk-sticky>

    <div class="uk-navbar-right">
        <div>
            <ul class="uk-navbar-nav">
                <li id='home' class="uk-active"><a type="button" href="/Ecom/index.php" onclick="home()">Home</a></li>
            </ul>
        </div>
    </div>
    <div class="uk-navbar-center">
        <div>
            <ul class="uk-navbar-nav">
                <?php
                if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
                ?>
                    <li>
                        <a href="#"><?= $_SESSION['username'] ?></a>
                        <div class="uk-navbar-dropdown uk-light uk-background-secondary">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li><a href="./controllers/deconnexion.php">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a type="button" uk-toggle="target: #modal_panier" href="#modal-example" id="cartbutton" uk-toggle><span uk-icon="icon: cart; ratio:1.5"></span><span class="uk-label uk-label-warning"><small id="itemsincartnum"><?= $cart ?></small></span></a></li>
                <?php } else { ?>
                    <li id='log'><a type="button" href="/Ecom_/page/login.php" onclick="login()">Login</a></li>
                    <li id='sign'><a type=" button" href="/Ecom/page/signin.php" onclick="sign()">Sign In</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>