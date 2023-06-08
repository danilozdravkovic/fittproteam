<?php
    include_once ("../config/connection.php");
    if(isset($_SESSION['user'])){
        if(!$_SESSION['user']->votedFor){
            if(isset($_POST['pollItem'])){
                global $conn;
                $voteValue = $_POST['pollItem'];
                $query="SELECT noOfVotes FROM fatlosingpoll WHERE id=$voteValue";
                $noOfVotes = $conn->query($query)->fetch();
                $newNumberOfVotes = $noOfVotes->noOfVotes +1;
                $userID =$_SESSION['user']->id;
                try{
                    global $conn;
                    $conn->beginTransaction();
                    $conn->exec("UPDATE fatlosingpoll SET noOfVotes=$newNumberOfVotes WHERE id=$voteValue");
                    $conn->exec("UPDATE users SET votedFor=$voteValue WHERE id=$userID");
                    $conn->commit();
                    $_SESSION['user']->votedFor = $voteValue;
                    $msg="Vaš glas je uspešno zabeležen";
                    header("Location: ../index.php?msg=".$msg);
                }
                catch (PDOException $ex){
                    //create_log(ERROR_LOG_FAJL, $ex->getMessage());
                    $error = "Greška pri komunikaciji sa serverom, probajte kasnije ponovo.";
                    header("Location: ../index.php?error=".$error);
                }
            }
            else{
                $error = "Morate odabrati jedno polje!";
                header("Location: ../index.php?error=".$error);
            }
        }
        else{
            $error = "Već ste poslali svoj glas!";
            header("Location: ../index.php?error=".$error);
        }
    }
    else{
        $error = "Morate biti prijavljeni da biste glasali.";
        header("Location: ../index.php?error=".$error);
    }