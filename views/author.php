<?php
include_once ("config/connection.php");
include_once ("views/fixed/head.php");
require_once ("models/functions.php");
addToLogFile();
?>
<div class="container-fluid" id="authorHeader">
    <div id="transparent">
        <?php
        include_once ("views/fixed/header.php");
        ?>
        <h1 class="text-white text-uppercase text-center mt-5 pb-5 fw-bolder">Autor</h1>
    </div>
</div>
<section>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="mt-5 text-center">Danilo Zdravković</h2>
                </div>
                <div class="col-12 col-md-6 mt-5 d-flex align-items-lg-center">
                    <p style="font-size: 2em" id="aboutMe">Ja sam Danilo Zdravković.Dolazim iz Srbije i bavim se webom,studiram na visokoj školi ICT.Uživam u pravljenju sajtova i volim svoj posao.Svakodnevno učim nove stvari i trudim se da povećam svoje znanje.Strastven sam u svom poslu i tu strast klijenti primete.</p>
                </div>
                <div class="col-12 col-md-6 mb-5 mt-5 ">
                    <img src="assets/img/me.jpg" class="img-fluid bg-dark" alt="author" />
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
