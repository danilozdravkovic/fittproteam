<?php
    function selectQueryWithLimit($table,$from,$to){
        global $conn;
        $query = "SELECT * FROM ".$table." LIMIT ".$from.",".$to;
        return $conn->query($query)->fetchAll();
    }

    function numberOf($alias,$table){
        global $conn;
        $query = "SELECT COUNT(*) AS ".$alias." FROM ".$table;
        return $conn->query($query)->fetch();
    }

    function selectQuery($table){
        global $conn;
        $query = "SELECT * FROM ". $table;
        return $conn->query($query)->fetchAll();
    }

    function selectFromTwoTablesForOneUser($table1,$alias1,$table2,$alias2,$key,$foreignKey,$userID){
        global $conn;
        $query = "SELECT * FROM $table1 AS $alias1 INNER JOIN $table2 AS $alias2 ON $alias1.$key=$alias2.$foreignKey WHERE userID=$userID";
        return $conn->query($query)->fetchAll();
    }

    function selectFromTwoTables($table1,$alias1,$table2,$alias2,$key,$foreignKey){
        global $conn;
        $query = "SELECT * FROM $table1 AS $alias1 INNER JOIN $table2 AS $alias2 ON $alias1.$key=$alias2.$foreignKey";
        return $conn->query($query)->fetchAll();
    }

    function selectQueryWithCondition($table,$id){
        global $conn;
        $query = "SELECT * FROM $table WHERE id=$id";
        return $conn->query($query)->fetch();
    }

    function addToLogFile(){
        $userIP = $_SERVER['REMOTE_ADDR'];
        if(isset($_SESSION['user'])){
           $username=$_SESSION['user']->username;
        }
        else{
            $username="Unauthorized";
        }
        $currentPage = $_SERVER['REQUEST_URI'];
        $currentDateTime  = date("d.m.Y H:i:s");

        $addLog = $userIP."\t".$username."\t".$currentPage."\t".$currentDateTime."\n";
        $logFile=fopen("log.txt","a");
        fwrite($logFile,$addLog);
        fclose($logFile);

    }

    function calculatePercentage($counter){
        global $noOfLogs;
        return round(100*$counter/$noOfLogs,2);
    }

