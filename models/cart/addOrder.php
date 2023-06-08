<?php
    include_once ("../../config/connection.php");
    header('Content-type: application/json');
    global $conn;
    $regexAdress = "/^[A-z\dŠĐŽĆČšđžćč\.]+(\s[A-z\dŠĐŽĆČšđžćč\.]+)+,(\s?([A-ZŠĐŽĆČ][a-zšđžćč]+)+)+$/";
    $regexCardNumber = "/^[0-9]{16}$/";
    $regexCardExpiresDate = "/^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/";

if(isset($_POST['adress']) && !empty($_POST['adress']) && isset($_POST['cardNumber']) && !empty($_POST['cardNumber']) && isset($_POST['expires']) && !empty($_POST['expires']) && !empty($_POST['cvvNumber']) ){
    if(!preg_match($regexAdress,$_POST['adress'])){
        $error = "Neispravna adresa";
        echo json_encode(["error"=>$error]);
        http_response_code(400);
        die();
    }
    if(!preg_match($regexCardNumber,$_POST['cardNumber'])){
        $error = "Neispravan broj kartice";
        echo json_encode(["error"=>$error]);
        http_response_code(400);
        die();
    }
    if(!preg_match($regexCardExpiresDate,$_POST['expires'])){
        $error = "Neispravan datum isteka";
        echo json_encode(["error"=>$error]);
        http_response_code(400);
        die();
    }

    $adress = $_POST['adress'];
    $cardNumber = $_POST['cardNumber'];
    $expires = $_POST['expires'];
    $cvvNumber = $_POST['cvvNumber'];
    $price = $_SESSION['cartPrice'];
    $userID=$_SESSION['user']->id;

    try{
        global $conn;
        $query=$conn->prepare("INSERT INTO orders(userID,adress,cardNumber,expireCardDate,cvvCardNumber,price) VALUES (?,?,?,?,?,?)");
        $query->execute([$userID,$adress,$cardNumber,$expires,$cvvNumber,$price]);
        $orderID=$conn->lastInsertId();
        $products=$_SESSION['products'];
        foreach ($products as $product) {
            $query=$conn->prepare("INSERT INTO orders_products(orderID,productID,quantity) VALUES (?,?,?)");
            $query->execute([$orderID,$product->productID,$product->quantity]);
        }
        $msg="Uspešno kreirana porudžbina!";
        echo json_encode(["msg"=>$msg]);
        http_response_code(200);
    }
    catch (PDOException $ex){
        var_dump($ex);
    }
}
else{
    $error = "Niste popunili sve podatke u traženom formatu";
    echo json_encode(["error"=>$error]);
    http_response_code(400);
    die();
}

?>