<?php
include_once ("../config/connection.php");
header('Content-type: application/json');
global $conn;
$regexNameLastName = "/^[A-ZŠĐŽĆČ][a-zšđžćč]{2,15}(\s[A-ZŠĐŽĆČ][a-zšđžćč]{2,15}){0,2}$/";
$regEmail = "/^[a-z]((\.|-|_)?[a-z0-9]){2,}@[a-z]((\.|-|_)?[a-z0-9]+){2,}\.[a-z]{2,6}$/i";

if(isset($_POST['nameLastName']) && !empty($_POST['nameLastName']) && isset($_POST['emailSendMsg']) && !empty($_POST['emailSendMsg']) && isset($_POST['message']) && !empty($_POST['message']) ){
    if(!preg_match($regexNameLastName,$_POST['nameLastName'])){
        $error = "Neispravno ime i prezime";
        header("Location: ../index.php?page=contact&error=".$error);
        die();
    }
    if(!preg_match($regEmail,$_POST['emailSendMsg'])){
        $error = "Neispravan email";
        header("Location: ../index.php?page=contact&error=".$error);
        die();
    }

    $name = $_POST['nameLastName'];
    $email = $_POST['emailSendMsg'];
    $message = $_POST['message'];

    mail("fittproteam1@gmail.com,admin1@gmail.com",$name,$message);
    $msg="Poruka uspešno poslata!";
    header("Location: ../index.php?page=contact&msg=".$msg);
}
else{
    $error = "Niste popunili sve podatke u traženom formatu";
    header("Location: ../index.php?page=contact&error=".$error);
    die();
}

?>

