<div class="row pt-5" id="panelHeader">
    <div class="col-10">
        <h1>Welcome
            <?php
                echo $_SESSION['user']->username;
            ?>
        </h1>
    </div>
    <div class="col-2">
        <div id="adminInicial"><p class="text-center"><?php echo substr($_SESSION['user']->username,0,1)?></p></div>
        <div><a class="text-dark" href="models/user/doLogout.php">Log Out</a></div>
    </div>
</div>

