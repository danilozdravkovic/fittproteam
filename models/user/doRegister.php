<?php
include_once ("../../config/connection.php");
header('Content-type: application/json');
global $conn;
$regexNameLastName = "/^[A-ZŠĐŽĆČ][a-zšđžćč]{2,15}(\s[A-ZŠĐŽĆČ][a-zšđžćč]{2,15}){0,2}$/";
$regEmail = "/^[a-z]((\.|-|_)?[a-z0-9]){2,}@[a-z]((\.|-|_)?[a-z0-9]+){2,}\.[a-z]{2,6}$/i";
$regPassword = "/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,32}$/";
if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) ){
    if(!preg_match($regexNameLastName,$_POST['name'])){
        $error = "Neispravno ime";
        header("Location: ../../index.php?page=register&error=".$error);
        die();
    }
    if(!preg_match($regEmail,$_POST['email'])){
        $error = "Neispravan email";
        header("Location: ../../index.php?page=register&error=".$error);
        die();
    }
    if(!preg_match($regPassword,$_POST['password'])){
        $error = "Neispravna lozinka";
        header("Location: ../../index.php?page=register&error=".$error);
        die();
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $verificationPass = rand(10000,100000);

    try{
        global $conn;
        $query=$conn->prepare("INSERT INTO users(username,email,password,roleID,active,verificationPass) VALUES (?,?,?,?,?,?)");
        $query->execute([$name,$email,$password,1,0,$verificationPass]);
        $userID=$conn->lastInsertId();
        mail("danedanedane44@gmail.com","Potvrda registracije","<a href='http://localhost/models/verifyEmail?id=$userID&pass=$verificationPass'>Kliknite ovde kako biste završili registraciju</a>");
        $msg="Proverite svoju email adresu kako biste završili registraciju";
        header("Location: ../../index.php?page=register&msg=".$msg);
    }
    catch (PDOException $ex){
        //create_log(ERROR_LOG_FAJL, $ex->getMessage());
        $error = "Greška pri komunikaciji sa serverom, probajte kasnije ponovo.";
        header("Location: ../../index.php?page=register&error=".$error);
    }
}
else{
    $error = "Niste popunili sve podatke u traženom formatu";
    header("Location: ../../index.php?page=register&error=".$error);
    die();
}

?>

