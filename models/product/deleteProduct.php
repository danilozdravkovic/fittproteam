<?php
include_once ("../../config/connection.php");
    if(isset($_GET['id'])){
        global $conn;
        $id=$_GET['id'];
        try{
            $conn->query("DELETE FROM products WHERE id=$id");
            header("Location: ../../index.php?page=adminPanel&adminPage=products");
        }
        catch (PDOException $ex){
            //create_log(ERROR_LOG_FAJL, $ex->getMessage());
            $error="You currently cant delete this product,because someone ordered it.";
            header("Location: ../../index.php?page=adminPanel&adminPage=products&error=".$error);
        }
    }