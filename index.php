<?php
require_once ("config/connection.php");
require_once ("views/fixed/head.php");
    $page = 'home';
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        }
    if(!file_exists("views/$page.php")){
        header("Location: index.php?page=home");
        }
require_once "views/$page.php";
?>
</body>
</html>