<?php
include_once ("config/connection.php");
include_once ("views/fixed/head.php");
require_once ("models/functions.php");
addToLogFile();
?>
<div class="container-fluid" id="main">
    <?php
    include_once ('views/fixed/header.php');
    ?>
    <section class="vh-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registruj se</p>

                                    <form class="mx-1 mx-md-4" method="post" action="models/user/doRegister.php" onsubmit="return validateRegisterData()">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline input flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">Ime</label>
                                                <input type="text" id="name" name="name" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline input flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c">Email</label>
                                                <input type="email" id="email" name="email" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline input flex-fill mb-0">
                                                <label class="form-label" for="form3Example4c">Lozinka</label>
                                                <input type="password"  id="password" name="password" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline input flex-fill mb-0">
                                                <label class="form-label"  for="form3Example4cd">Ponovi lozinku</label>
                                                <input type="password" id="repeatPass" name="repeatPass" class="form-control" />
                                            </div>
                                        </div>
                                        <div>
                                            <?php
                                                if(isset($_GET['error'])){
                                                    echo "<p class='alert alert-danger col-9 mt-3 mx-auto'>".$_GET["error"]."</p>";
                                                }
                                            if(isset($_GET['msg'])){
                                                echo "<p class='alert-success col-9 mt-3 mx-auto'>".$_GET["msg"]."</p>";
                                            }
                                            ?>
                                        </div>
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <input type="submit" value="Pošalji" class="btn btn-primary btn-lg"/>
                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                         class="img-fluid" alt="Sample image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>