<?php
    require_once ("models/functions.php");
?>
<div class="row">
    <nav class="navbar col-12 navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#"><img src="assets/img/logo.png" alt="logo"/> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                $menuData = selectQuery("menu");
                foreach ($menuData as $item):
                    ?>
                    <li class="nav-item active ml-2">
                        <a class="nav-link text-white" href="<?='index.php?page='.explode('.',$item->href)[0]?>"><?=$item->title?><span class="sr-only">(current)</span></a>
                    </li>
                <?php endforeach;?>
                <?php
                if(isset($_SESSION['user'])):
                    ?>
                    <?php if($_SESSION['user']->roleID==2):
                    ?>
                    <li class="nav-item active ml-2">
                        <a class="nav-link text-uppercase text-danger" href="index.php?page=adminPanel&adminPage=products">Admin Panel<span class="sr-only">(current)</span></a>
                    </li>
                    <?php endif;?>

                    <p><i class="fa fa-user" aria-hidden="true"></i><?=$_SESSION['user']->username?></p>
                    <li class="nav-item active ml-2">
                        <a class="nav-link text-white" href="models/user/doLogout.php">Logout<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active ml-2">
                        <a class="nav-link text-white" href="index.php?page=cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="sr-only">(current)</span></a>
                    </li>
                    <?php
                         else:
                    ?>
                             <li class="nav-item active ml-2">
                                 <a class="nav-link text-white" href="index.php?page=login">Login<span class="sr-only">(current)</span></a>
                             </li>
                             <li class="nav-item active ml-2">
                                 <a class="nav-link text-white" href="index.php?page=register">Register<span class="sr-only">(current)</span></a>
                             </li>
                <?php endif;?>

            </ul>
        </div>
    </nav>
</div>
