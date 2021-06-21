<?php
include_once 'connexion.php';
$page = 'Home';
include_once './elements/header.php';
include_once './elements/navbar.php';
?>

<link rel="stylesheet" href="./assets/css/style.css">
<style>
     body{
        background-color: #ffffff;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 1200 800'%3E%3Cdefs%3E%3CradialGradient id='a' cx='0' cy='800' r='800' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%23ffffff'/%3E%3Cstop offset='1' stop-color='%23ffffff' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='b' cx='1200' cy='800' r='800' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%23ffffff'/%3E%3Cstop offset='1' stop-color='%23ffffff' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='c' cx='600' cy='0' r='600' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%23ffffff'/%3E%3Cstop offset='1' stop-color='%23ffffff' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='d' cx='600' cy='800' r='600' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%23ffffff'/%3E%3Cstop offset='1' stop-color='%23ffffff' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='e' cx='0' cy='0' r='800' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%23ffffff'/%3E%3Cstop offset='1' stop-color='%23ffffff' stop-opacity='0'/%3E%3C/radialGradient%3E%3CradialGradient id='f' cx='1200' cy='0' r='800' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%23ffffff'/%3E%3Cstop offset='1' stop-color='%23ffffff' stop-opacity='0'/%3E%3C/radialGradient%3E%3C/defs%3E%3Crect fill='url(%23a)' width='1200' height='800'/%3E%3Crect fill='url(%23b)' width='1200' height='800'/%3E%3Crect fill='url(%23c)' width='1200' height='800'/%3E%3Crect fill='url(%23d)' width='1200' height='800'/%3E%3Crect fill='url(%23e)' width='1200' height='800'/%3E%3Crect fill='url(%23f)' width='1200' height='800'/%3E%3C/svg%3E");
        background-attachment: fixed;
        background-size: cover;     
        }
</style>
<body <?php if (!isset($_SESSION['id'])) { ?> onload="home();" <?php } else { ?> onload="logedhome();" <?php } ?>>
    <div align='center' id="ro">
        <?php include_once "./controllers/products.php";
        include_once "./controllers/addtocart.php"; ?>
        <h4>Bonjour</h4>
        
        <div align='left' id="divis" class="uk-width-6-7 uk-child-width-1-2@s uk-child-width-1-5@l uk-text-center" uk-grid uk-height-match="target: > div > .uk-card">
            <?php if ($checker > 0) {
                while ($a = $article->fetch()) { ?>
                    <div>
                        <div class="uk-box-shadow-hover-large uk-animation-shake">
                            <div class="uk-card-media-top uk-animation-shake-up uk-cover-container">
                                <div class="uk-text" uk-lightbox>
                                    <a ,href="<?= $a['image'] ?>"><img src="<?= $a['image'] ?>" width="200px" height="100px" alt="<?= $a['name'] ?>"></a>
                                </div>
                            </div>
                            <div class="uk-card-body">
                                <h5><?= $a['name'] ?></h5>
                                <small id="ar<?= $a['sku'] ?>"></small>
                            </div>
                            <div class="uk-card-footer uk-width-expand">
                                <a class="uk-button-info uk-button uk-button-info" href="#modal-full<?= $a['sku'] ?>" uk-toggle><small>Add to cart</small></a>
                                <br> <?= $a['price'] ?>$
                            </div>
                        </div>
                    </div>


                    <div id="modal-full<?= $a['sku'] ?>" class="uk-modal-container" style="display: none;" uk-modal>
                        <div class="uk-modal-dialog">
                            <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
                            <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
                                <div class="uk-background-secondary" style="background-image: url(<?= $a['image'] ?>);" uk-height-viewport></div>
                                <div class="uk-padding-large">
                                    <h1><?= $a['name'] ?></h1>
                                    <p><?= $a['description'] ?></p>
                                    <form action="./controllers/addtocart.php" method="post">
                                        <div class="uk-width-1 uk-align-left">
                                            <input <?php if (!isset($_SESSION['id'])) echo 'disabled' ?> required class="uk-input" name="qte" type="number" min="1" placeholder="Quantity">
                                        </div>
                                        <input required name="id" type="hidden" value="<?= $a['sku'] ?>">
                                        <?php if (isset($_SESSION['id']) && !empty($_SESSION['id'])) { ?>
                                            <button class="uk-button uk-button-secondary uk-align-center addtocartform" type="submit">Add</button>
                                        <?php } else { ?>
                                            <a class="uk-button uk-button-secondary uk-width-2-3@s uk-align-center" type="button" href="./page/login.php">Login Required</a>
                                        <?php } ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php  }
            } ?>
        </div>
        <ul class="uk-pagination uk-flex-center" uk-margin>
            <li><a href="index.php?page=<?= $pageCourante - 1 ?>"><span uk-pagination-previous></span></a></li>
            <li><a id="pagenum1" href="index.php?page=<?= 1 ?>">1</a></li>
            <?php if ($pageCourante > 7 && $pageCourante <= $pageTotal) { ?><li class="uk-disabled"><span>...</span></li><?php } ?>
            <?php if ($pageCourante > 6 && $pageCourante < 426) {
                for ($i = $pageCourante - 5; $i <= $pageCourante + 5; $i++) { ?>
                    <li><a id="pagenum<?= $i ?>" href="index.php?page=<?= $i ?>"><?= $i ?></a></li>
                <?php }
            } else if ($pageCourante >= 1 && $pageCourante <= 6) {
                for ($i = 2; $i <= 10; $i++) { ?>
                    <li><a id="pagenum<?= $i ?>" href="index.php?page=<?= $i ?>"><?= $i ?></a></li>
                <?php }
            } else {
                for ($i = 422; $i <= 430; $i++) { ?>
                    <li><a id="pagenum<?= $i ?>" href="index.php?page=<?= $i ?>"><?= $i ?></a></li>
            <?php }
            } ?>
            <?php if ($pageCourante >= 1 && $pageCourante < $pageTotal - 6) { ?><li class="uk-disabled"><span>...</span></li><?php } ?>
            <li><a id="pagenum431" href="index.php?page=<?= 431 ?>">431</a></li>
            <li><a href="index.php?page=<?= $pageCourante + 1 ?>"><span uk-pagination-next></span></a></li>
        </ul>
    </div>

    <div id="modal_panier" uk-modal>
        <div class="uk-position-center uk-text-primary" uk-spinner="ratio: 3"></div>
    </div>

</body>

<script>
    $(".addtocartform").click(function() {
        var frm = $(this).parent()
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function(data) {
                console.log('Submission was successful.');
                console.log(data);
                if (data.split('|')[2] != 'uk-alert-danger') {
                    document.getElementById('itemsincartnum').innerHTML = data.split('|')[1];
                }
                UIkit.notification({
                    message: '<div class="' + data.split('|')[2] + '" uk-alert><a class="uk-alert-close" uk-close></a><span uk-icon=\'icon: check\'></span><p>' + data.split('|')[0] + '</p></div>',
                    status: 'success',
                    pos: 'bottom-right',
                    timeout: 5000
                });
            }
        });
        return false;
    });

    $("#cartbutton").click(function() {
        $("#modal_panier").load("./elements/cart.php");
    });
</script>

<script defer src="./assets/js/scripts.js"></script>

<?php include_once './elements/footer.php'; ?>