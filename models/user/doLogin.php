<?php
include_once ("../../config/connection.php");
header('Content-type: application/json');
global $conn;
$regEmail = "/^[a-z]((\.|-|_)?[a-z0-9]){2,}@[a-z]((\.|-|_)?[a-z0-9]+){2,}\.[a-z]{2,6}$/i";
$regPassword = "/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,32}$/";

if(isset($_POST['emailLogin']) && !empty($_POST['emailLogin']) && isset($_POST['passwordLogin']) && !empty($_POST['passwordLogin']) ){
    if(!preg_match($regEmail,$_POST['emailLogin'])){
        $error = "Neispravan email";
        header("Location: ../../index.php?page=login&error=".$error);
        die();
    }
    if(!preg_match($regPassword,$_POST['passwordLogin'])){
        $error = "Neispravna lozinka";
        header("Location: ../../index.php?page=login&error=".$error);
        die();
    }
    $email = $_POST['emailLogin'];
    $password = md5($_POST['passwordLogin']);
    $lastInsertedEmail = isset($_SESSION['lastInsertedEmail']) ? $_SESSION['lastInsertedEmail'] : "";
    $counter = isset($_SESSION['counter']) ? $_SESSION['counter'] : 1;


    try {
        global $conn;

        $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $query->execute([$email]);
        $user = $query->fetch();

    } catch (PDOException $ex) {

        //createLog(ERROR_LOG_FILE, $ex->getMessage());
        $error = "Greška pri komunikaciji sa serverom, probajte kasnije ponovo.";
        header("Location: ../../index.php?page=login&error=".$error);
    }


    if($user->password == $password && $user ){
        if ($user->active == "0"){
            $error = "Vaš nalog je blokiran. Kontaktirajte administratora ";
            header("Location: ../../index.php?page=login&error=".$error);
            die();
        }
        $_SESSION["user"] = $user;
        unset($_SESSION['lastInsertedEmail']);
        unset($_SESSION['counter']);
        $currentTimestamp  = strtotime(date("d.m.Y H:i:s"));
        $id = $user->id;
        $query=$conn->prepare('UPDATE users SET lastTimeLoggedIn=? WHERE id=?');
        $query->execute([$currentTimestamp,$id]);
        header("Location: ../../index.php?page=home");
    }
    else {
        if($lastInsertedEmail == $email){
            $counter++;
        }
        else{
            $counter=1;
        }
        $lastErrorTimestamp=0;
        $firstErrorTimestamp=0;
        if($counter==1){
            $firstErrorTimestamp  = strtotime(date("d.m.Y H:i:s"));
            $_SESSION['firstErrorTimestamp']=$firstErrorTimestamp;
        }
        if($lastInsertedEmail == $email && $counter==3){
            $lastErrorTimestamp  = strtotime(date("d.m.Y H:i:s"));
        }
        if($counter==3 && ($lastErrorTimestamp-$_SESSION['firstErrorTimestamp'])<300){
            $query=$conn->prepare('UPDATE users SET active=? WHERE email=?');
            $query->execute([0,$email]);
            mail($email,"Greska pri autentifikaciji","Usled neispravno unetih kredencijala za logovanje 3 puta u roku od 5 minuta vas
             nalog je blokiran.Kontaktirajte administratora za vise informacija.");
        }
        $_SESSION['lastInsertedEmail']=$email;
        $_SESSION['counter'] = $counter;
        $error = "Neispravna email adresa ili lozinka.";
        header("Location: ../../index.php?page=login&error=".$error);
    }
}
else{
    $error = "Niste popunili sve podatke u traženom formatu";
    header("Location: ../../index.php?page=login&error=".$error);
    die();
}

