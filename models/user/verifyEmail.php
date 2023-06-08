<?php
    include_once ("../config/connection.php");
    if(isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['verificationPass']) && !empty($_GET['verificationPass'])){
        global $conn;
        $query=$conn->prepare("UPDATE useres SET active=? WHERE id=? AND verificationPass=?");
        $query->execute([1,$_GET['id'],$_GET['verificationPass']]);
    }
    header("Location: ../login.php");
    ?>