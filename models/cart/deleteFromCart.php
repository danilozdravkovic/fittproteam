<?php
include_once ("../../config/connection.php");
    if(isset($_GET['id'])){
        try{
            global $conn;
            $productID=$_GET['id'];
            $conn->query("DELETE FROM cart WHERE productID=$productID");
            header("Location: ../../index.php?page=cart");
        }
         catch (PDOException $ex) {
            //create_log(ERROR_LOG_FAJL, $ex->getMessage());
            $error = "Greška pri komunikaciji sa serverom, probajte kasnije ponovo.";
            header("Location: ../../index.php?page=cart&error=" . $error);
}
    }
