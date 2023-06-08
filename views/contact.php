<?php
include_once ("config/connection.php");
include_once ("views/fixed/head.php");
require_once ("models/functions.php");
addToLogFile();
?>
<div class="container-fluid contactSection" id="contactHeader">
    <?php
    include_once ("views/fixed/header.php");
    ?>
    <div class="container" >
        <div class="row" id="contactForm">
            <div class="col-5 bg-white border" id="formAbsolute">
                <h1 class="ml-5 mt-5"><span class="greenColor">KONTAKTIRAJTE</span> NAS</h1>
                <form id="contact-form" class="mx-auto my-5 " name="contact-form" onsubmit="return validateSendMsgData()" method="post" action="models/sendMessage.php">
                    <div class="form-group">
                        <label for="name">Ime i prezime</label>
                        <input type="text" name="nameLastName" id="nameLastName" data-title="name" class="form-control" value=""/>
                    </div>
                    <div class="form-group">
                        <label for="username">E-mail:</label>
                        <input type="text" name="emailSendMsg" id="emailSendMsg" data-title="e-mail" class="form-control" value=""/>
                    </div>
                    <div class="form-group">
                        <label for="username">Vaša poruka</label>
                        <textarea class="form-control" id="message" name="message" data-title="message"></textarea>
                    </div>
                    <?php
                    if(isset($_GET['error'])){
                        echo "<p class='alert alert-danger col-9 mt-3 mx-auto'>".$_GET["error"]."</p>";
                    }
                    if(isset($_GET['msg'])){
                        echo "<p class='alert-success col-9 mt-3 mx-auto'>".$_GET["msg"]."</p>";
                    }
                    ?>
                    <input type="submit" value="POŠALJI PORUKU" name="btn-send" id="btn-send" class="btn text-white"/>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid contactSection" id="pictureHolder">
    <div id="orange1">
        <img class="card-img-top" src="assets/img/orange.png" alt="orange" />
    </div>
    <div id="orange2">
        <img class="card-img-top" src="assets/img/orange.png" alt="orange" />
    </div>
</div>
<div class="container-fluid mt-5" style="background-color:#e2e2e2;">
    <div class="row">
        <div class="col-4 mt-5 mb-5 text-center">
            <i class=" gdlr-core-icon-item-icon fa fa-clock-o" style="color: #71bb03 ;font-size: 40px ;min-width: 40px ;min-height: 40px ;"></i>
            <h2 class="text-uppercase font-weight-bold mt-3">Radno vreme</h2>
            <p>
                Pon – Pet: 08:00 – 20:00</br>
                Sub: 09-15 </br>
                Nedelja: 09-15
            </p>
        </div>
        <div class="col-4 mt-5 mb-5 text-center">
            <i class=" gdlr-core-icon-item-icon fa fa-map-marker" style="color: #71bb03 ;font-size: 40px ;min-width: 40px ;min-height: 40px ;"></i>
            <h2 class="text-uppercase font-weight-bold mt-3">Adresa</h2>
            <p>
                Mačvanska 23, Vračar,
                11000 Beograd
            </p>
        </div>
        <div class="col-4 mt-5 mb-5 text-center">
            <i class=" gdlr-core-icon-item-icon fa fa-phone" style="color: #71bb03 ;font-size: 40px ;min-width: 40px ;min-height: 40px ;"></i>
            <h2 class="text-uppercase font-weight-bold mt-3">Telefon</h2>
            <p>
                +381 62 668 845
            </p>
        </div>
    </div>
</div>
<div id="map">
    <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=Beograd Mačvanska Vračar&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://kokagames.com/">FNF</a></div><style>.mapouter{position:relative;text-align:right;width:100%;height:400px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:400px;}.gmap_iframe {height:400px!important;}</style></div>
</div>
<?php
include_once ("views/fixed/footer.php");
?>
<script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>
