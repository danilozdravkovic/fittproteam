<?php
    include_once ("../../config/connection.php");
    if(isset($_GET['insertedValue']) && !empty($_GET['insertedValue'])){
        $insetredValue = strtolower(addslashes($_GET['insertedValue']));
        try{
            global $conn;
            $filteredProducts=$conn->query("SELECT * FROM products WHERE LOWER(title) LIKE '%$insetredValue%'");
            $filteredProducts=$filteredProducts->fetchAll();
            header("Content-type:application/json");
            echo json_encode(["products"=>$filteredProducts]);
            http_response_code(200);
        }
        catch (PDOException $ex){
            //create_log(ERROR_LOG_FAJL, $ex->getMessage());
            $error = $ex;
            header("Content-type:application/json");
            echo json_encode(["error"=>$error]);
            http_response_code(500);
        }
    }

if(isset($_GET['startIndexNumber'])){
    $insetredValue = $_GET['startIndexNumber'];
    $offsetNumber = 8;
    $limit = $insetredValue * $offsetNumber;
    try{
        global $conn;
        $filteredProducts=$conn->query("SELECT * FROM products LIMIT $limit,$offsetNumber");
        $filteredProducts=$filteredProducts->fetchAll();
        header("Content-type:application/json");
        echo json_encode(["products"=>$filteredProducts]);
        http_response_code(200);
    }
    catch (PDOException $ex){
        //create_log(ERROR_LOG_FAJL, $ex->getMessage());
        $error = $ex;
        header("Content-type:application/json");
        echo json_encode(["error"=>$error]);
        http_response_code(500);
    }
}
