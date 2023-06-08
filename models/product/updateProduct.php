<?php
include_once ("../../config/connection.php");
    if(isset($_POST['id'])){
        global $conn;
        $title = $_POST['title'];
        $price = (int)$_POST['price'];
        $onSale= (int)$_POST['onSale'];
        $id= (int)$_POST['id'];
        $updatedAt = date("Y-m-d H:i:s");
        try{
            $query=$conn->prepare('UPDATE products SET title=?,price=?,onSale=?,updated_at=? WHERE id=?');
            $query->execute([$title,$price,$onSale,$updatedAt,$id]);
            $msg="Uspešno ste izmenili podatke";
            header("Location: ../../index.php?page=adminPanel&adminPage=updateProduct&id=".$id."&msg=".$msg);
        }
        catch (PDOException $ex){
            //create_log(ERROR_LOG_FAJL, $ex->getMessage());
            $error = "Greška pri komunikaciji sa serverom, probajte kasnije ponovo.";
            header("Location: ../../index.php?page=adminPanel&adminPage=updateProduct&id=".$id."&error=".$error);
        }
    }