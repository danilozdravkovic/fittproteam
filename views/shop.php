<?php
include_once ("config/connection.php");
include_once ("views/fixed/head.php");
require_once ("models/functions.php");
addToLogFile();
?>
    <div class="container-fluid" id="shopHeader">
        <?php
            include_once ("views/fixed/header.php");
        ?>
        <h1 class="text-white text-uppercase text-center mt-5 pb-5 fw-bolder">Prodavnica</h1>
    </div>
    <section>
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-3">
                    <form>
                        <div class="input-group mb-3">
                            <button class="btn btn-outline-secondary" type="button" id="buttonSearchProducts">Pretraži</button>
                            <input type="text" class="form-control" id="searchProducts" aria-label="Example text with button addon" aria-describedby="button-addon1"/>
                        </div>
                        <button type="button" id="reload" class="btn btn-secondary">Prikaži sve proizvode</button>
                    </form>
                </div>
                <div class="col-9">
                    <div class="row" id="productsMenu">
                    <?php
                    $products = selectQueryWithLimit("products",0,8);
                    foreach ($products as $product):
                        ?>
                        <div class="col-3 mb-5">
                            <div class="card h-100">
                                <!-- Sale badge-->
                                <?php
                                if ($product->onSale):
                                    ?>
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                <?php endif;?>
                                <!-- Product image-->
                                <img  src="assets/img/<?=$product->src?>" alt="<?=$product->alt?>" />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?=$product->title?></h5>
                                        <!-- Product price-->
                                        <span class="text-muted text-decoration-line-through"><?=$product->price?> DIN</span>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="models/cart/addToCart.php?id=<?=$product->id?>">Dodaj u korpu</a></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                        <?php
                        if(isset($_GET['error'])){
                            echo "<p class='alert alert-danger col-9 mt-3 mx-auto'>".$_GET["error"]."</p>";
                        }
                        if(isset($_GET['msg'])){
                            echo "<p class='alert alert-success  col-9 mt-3 mx-auto'>".$_GET["msg"]."</p>";
                        }
                        ?>
                    </div>
                    <div class="row">
                        <nav aria-label="..." id="paginationNav">
                            <ul class="pagination" id="paginationUl">
                                <?php
                                    $offsetNumber = 8;
                                    $numberOfProducts = numberOf("numberOfProducts","products");
                                    $numberOfPages = ceil($numberOfProducts->numberOfProducts/$offsetNumber);
                                    for($i=0;$i<$numberOfPages;$i++):
                                ?>
                                        <li class="page-item" ><a class="page-link" data-number="<?=$i?>" href="#"><?=$i+1?></a></li>
                                <?php endfor;?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
include_once ("views/fixed/footer.php");
?>
<script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>
