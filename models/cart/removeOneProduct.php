<?php
include_once ("../../config/connection.php");
if(isset($_GET['id'])){
    global $conn;
    $productID = $_GET['id'];
        try {
            $productQuantity = $conn->query("SELECT quantity FROM cart WHERE productID=$productID")->fetch();
            if($productQuantity->quantity>1) {
                $newQuantity = $productQuantity->quantity - 1;
                $conn->query("UPDATE cart SET quantity=$newQuantity WHERE productID=$productID");
                header("Location: ../../index.php?page=cart");
            }
            else{
                header("Location: ../../index.php?page=cart");
            }
        } catch (PDOException $ex) {
            //create_log(ERROR_LOG_FAJL, $ex->getMessage());
            $error = "Greška pri komunikaciji sa serverom, probajte kasnije ponovo.";
            header("Location: ../../index.php?page=cart&error=" . $error);
        }
}
