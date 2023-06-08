<?php
include_once ("../../config/connection.php");
if(isset($_SESSION['user'])) {
    if (isset($_GET['id'])) {
        $productID = $_GET['id'];
        $userID=$_SESSION['user']->id;
        global $conn;
        $product = $conn->query("SELECT * FROM cart WHERE productID=$productID AND userID=$userID  ")->fetch();
        if ($product) {
            $quantity = $product->quantity;
            $quantity += 1;
            try {
                $conn->query("UPDATE cart SET quantity=$quantity WHERE productID=$productID AND userID=$userID");
                $msg = "Proizvod dodat u korpu";
                header("Location: ../../index.php?page=shop&msg=" . $msg);
            } catch (PDOException $ex) {
                //create_log(ERROR_LOG_FAJL, $ex->getMessage());
                $error = "Greška pri komunikaciji sa serverom, probajte kasnije ponovo.";
                header("Location: ../../index.php?page=shop&error=" . $error);
            }
        } else {
            try {
                $userID = $_SESSION['user']->id;
                $quantity = 1;
                $query = $conn->prepare("INSERT INTO cart(userID,productID,quantity) VALUES (?,?,?)");
                $query->execute([$userID, $productID, $quantity]);
                $msg = "Proizvod dodat u korpu";
                header("Location: ../../index.php?page=shop&msg=" . $msg);
            } catch (PDOException $ex) {
                //create_log(ERROR_LOG_FAJL, $ex->getMessage());
                $error = "Greška pri komunikaciji sa serverom, probajte kasnije ponovo.";
                header("Location: ../../index.php?page=shop&error=" . $error);
            }
        }
    }
}
else{
    $error = "Morate bili ulogovani kako biste dodali proizvod u korpu!";
    header("Location: ../../index.php?page=shop&error=" . $error);
}




