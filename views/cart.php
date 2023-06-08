<?php
include_once ("config/connection.php");
include_once ("views/fixed/head.php");
require_once ("models/functions.php");
addToLogFile();
?>
<section class="h-100 h-custom" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card">
                    <div class="card-body p-4">

                        <div class="row">

                            <div class="col-lg-7">
                                <h5 class="mb-3"><a href="index.php?page=shop" class="text-body"><i
                                            class="fas fa-long-arrow-alt-left me-2"></i>Nastavite sa kupovinom</a></h5>
                                <hr>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div>
                                        <p class="mb-1">Korpa</p>
                                    </div>
                                </div>

                                <?php
                                    $userID=$_SESSION['user']->id;
                                    $products = selectFromTwoTablesForOneUser("cart","c","products","p","productID","id",$userID);
                                    $_SESSION['products']=$products;
                                    foreach ($products as $product):
                                ?>


                                <div class="card mb-3 mb-lg-0">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-row align-items-center">
                                                <div>
                                                    <img
                                                        src="assets/img/<?=$product->src?>"
                                                        class="img-fluid rounded-3" alt="<?=$product->alt?>" style="width: 65px;">
                                                </div>
                                                <div class="ms-3">
                                                    <h5><?=$product->title?></h5>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center">
                                                <div style="width: 50px;">
                                                    <a href="models/cart/addOneProduct.php?id=<?=$product->id?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                </div>
                                                <div  style="width: 50px;">
                                                    <h5 class="fw-normal mb-0 ml-1 mr-1"><?=$product->quantity?> </h5>
                                                </div>
                                                <div style="width: 50px;">
                                                    <a href="models/cart/removeOneProduct.php?id=<?=$product->id?>"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                                </div>
                                                <div style="width: 80px;">
                                                    <h5 class="mb-0"><?=$product->price*$product->quantity ?> RSD</h5>
                                                </div>
                                                <a href="models/cart/deleteFromCart.php?id=<?=$product->id?>" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <?php endforeach;?>

                            </div>
                            <div class="col-lg-5">

                                <div class="card bg-primary text-white rounded-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <h5 class="mb-0">Podaci za dostavu</h5>
                                        </div>

                                        <p class="small mb-2">Tip kartice</p>
                                        <a href="#!" type="submit" class="text-white"><i
                                                class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                                        <a href="#!" type="submit" class="text-white"><i
                                                class="fab fa-cc-visa fa-2x me-2"></i></a>
                                        <a href="#!" type="submit" class="text-white"><i
                                                class="fab fa-cc-amex fa-2x me-2"></i></a>
                                        <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>

                                        <form class="mt-4">
                                            <div class="form-outline form-white mb-4">
                                                <input type="text" id="adress" class="form-control form-control-lg" siez="17"
                                                       placeholder="Adresa za slanje" />
                                                <label class="form-label" for="typeName">Adresa za slanje</label>
                                            </div>

                                            <div class="form-outline form-white mb-4">
                                                <input type="text" id="cardNumber" class="form-control form-control-lg" siez="17"
                                                       placeholder="1234567890123457" minlength="19" maxlength="16" />
                                                <label class="form-label" for="typeText">Broj kartice</label>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="form-outline form-white">
                                                        <input type="text" id="expires" class="form-control form-control-lg"
                                                               placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" />
                                                        <label class="form-label" for="typeExp">Datum isteka</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-outline form-white">
                                                        <input type="password" id="typeCvv" class="form-control form-control-lg"
                                                               placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                                                        <label class="form-label" for="typeText">Cvv</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between">
                                            <p class="mb-2">Ukupno</p>
                                            <p class="mb-2">
                                                <?php
                                                $fullPrice=0;
                                                foreach ($products as $product) {
                                                        $fullPrice+=$product->price*$product->quantity;
                                                    }
                                                echo $fullPrice;
                                                echo " RSD";
                                                ?>
                                            </p>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <p class="mb-2">Poštarina</p>
                                            <p class="mb-2">200 RSD</p>
                                        </div>

                                        <div class="d-flex justify-content-between mb-4">
                                            <p class="mb-2">Ukupno(sa PDV-om)</p>
                                            <p class="mb-2"><?php
                                                echo $fullPrice+200;
                                                echo " RSD";
                                                ?></p>
                                        </div>

                                        <button id="orderBtn" type="button" class="btn btn-info btn-block btn-lg">
                                            <div class="d-flex justify-content-between">
                                                <span><?php
                                                    echo $fullPrice+200;
                                                    echo " RSD";
                                                    $_SESSION['cartPrice']=$fullPrice+200;
                                                    ?></span>
                                                <span>Naruči <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                            </div>
                                        </button>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if(isset($_GET['error'])){
        echo "<p class='alert alert-danger col-9 mt-3 mx-auto'>".$_GET["error"]."</p>";
    }
    ?>
    <div id="messageCart">

    </div>
</section>
<script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>