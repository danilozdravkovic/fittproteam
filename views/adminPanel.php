<?php
include_once ("config/connection.php");
include_once ("views/fixed/head.php");
require_once ("models/functions.php");
addToLogFile();
if($_SESSION['user']->roleID==2):
    ?>
<div class="container-fluid">
    <div class="row">
        <?php
        include_once ("adminPanelFixed/nav.php");
        ?>
        <div class="col-10">
            <?php
            include_once ("views/adminPanelFixed/header.php");
            ?>

            <div class="row" id="adminMain">
                <?php
                    if(isset($_GET['adminPage']) && $_GET['adminPage']=="products"){
                        include_once ('adminPanelSections/products.php');
                        }
                    if(isset($_GET['adminPage']) && $_GET['adminPage']=="users"){
                        include_once ('adminPanelSections/users.php');
                        }
                    if(isset($_GET['adminPage']) && $_GET['adminPage']=="logActivity"){
                        include_once ('adminPanelSections/logActivity.php');
                        }
                    if(isset($_GET['adminPage']) && $_GET['adminPage']=="updateProduct"){
                        include_once ('adminPanelSections/updateProduct.php');
                    }
                if(isset($_GET['adminPage']) && $_GET['adminPage']=="pollResult"){
                    include_once ('adminPanelSections/pollResult.php');
                }
                ?>

            </div>
        </div>
    </div>
<?php
else:
    ?>
    <p class='alert alert-danger col-9 mt-3 mx-auto'>Nemate pravo pristupa traženoj stranici!</p>
<?php endif;?>


