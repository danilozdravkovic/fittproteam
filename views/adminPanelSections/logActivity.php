<?php
require_once ("models/functions.php");
    $logFile=file("log.txt");
    $indexCounter=0;
    $shopCounter=0;
    $registerCounter=0;
    $loginCounter=0;
    $contactCounter=0;
    $cartCounter=0;
    $authorCounter=0;
    $logActivityCounter=0;
    $pollResultsCounter=0;
    $productsCounter=0;
    $updateProductCounter=0;
    $usersCounter=0;
    $noOfLogs=0;
    foreach ($logFile as $oneLogLine){
        $array = explode("\t",$oneLogLine);
        $timeWhenLogActivityHappened = strtotime($array[3]);
        $currentDateTime  = strtotime(date("d.m.Y H:i:s"));
        if($currentDateTime-$timeWhenLogActivityHappened<24*60*60){
            $noOfLogs +=1;
            $url = $array[2];
            if(strpos($url,"&")){
                $partsOfUrl = explode("&",$url);
                $page = explode("=",$partsOfUrl[1])[1];
            }
            elseif(strpos($url,"=")){
                $page = explode("=",$url)[1];
            }
            else{
                $page = "index";
            }
            switch ($page){
                case "home":
                case "index":
                    $indexCounter+=1;
                    break;
                case "shop":
                    $shopCounter+=1;
                    break;
                case "register":
                    $registerCounter+=1;
                    break;
                case "login":
                    $loginCounter+=1;
                    break;
                case "contact":
                    $contactCounter+=1;
                    break;
                case "author":
                    $authorCounter+=1;
                    break;
                case "logActivity":
                    $logActivityCounter+=1;
                    break;
                case "pollResult":
                    $pollResultsCounter+=1;
                    break;
                case "products":
                    $productsCounter+=1;
                    break;
                case "updateProduct":
                    $updateProductCounter+=1;
                    break;
                case "users":
                    $usersCounter+=1;
                    break;
                case "cart":
                    $cartCounter+=1;
                    break;
            }
        }
    }
    $visitedIndexInPercentage = calculatePercentage($indexCounter);
    $visitedShopInPercentage = calculatePercentage($shopCounter);
    $visitedRegisterInPercentage = calculatePercentage($registerCounter);
    $visitedLoginInPercentage = calculatePercentage($loginCounter);
    $visitedContactInPercentage = calculatePercentage($contactCounter);
    $visitedCartInPercentage = calculatePercentage($cartCounter);
    $visitedAuthorInPercentage = calculatePercentage($authorCounter);
    $visitedLogActivityInPercentage = calculatePercentage($logActivityCounter);
    $visitedPollResultsInPercentage = calculatePercentage($pollResultsCounter);
    $visitedProductsInPercentage = calculatePercentage($productsCounter);
    $visitedUsersInPercentage = calculatePercentage($usersCounter);
    $visitedUpdateProductInPercentage = calculatePercentage($updateProductCounter);


?>
<div class="col">
    <h1 class="mt-5">Activity Log</h1>
        <table>
            <thead>
                <tr>
                    <th>Page</th>
                    <th>Number of visitors in last 24h</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>index.php?page=home</td>
                    <td style="padding-left: 10em"><?php echo $visitedIndexInPercentage?>%</td>
                </tr>
                <tr>
                    <td>index.php?page=shop</td>
                    <td style="padding-left: 10em"><?php echo $visitedShopInPercentage?>%</td>
                </tr>
                <tr>
                    <td>index.php?page=register</td>
                    <td style="padding-left: 10em"><?php echo $visitedRegisterInPercentage?>%</td>
                </tr>
                <tr>
                    <td>index.php?page=login</td>
                    <td style="padding-left: 10em"><?php echo $visitedLoginInPercentage?>%</td>
                </tr>
                <tr>
                    <td>index.php?page=contact</td>
                    <td style="padding-left: 10em"><?php echo $visitedContactInPercentage?>%</td>
                </tr>
                <tr>
                    <td>index.php?page=cart</td>
                    <td style="padding-left: 10em"><?php echo $visitedCartInPercentage?>%</td>
                </tr>
                <tr>
                    <td>index.php?page=author</td>
                    <td style="padding-left: 10em"><?php echo $visitedAuthorInPercentage?>%</td>
                </tr>
                <tr>
                    <td>index.php?page=adminPanel&adminPage=logActivity</td>
                    <td style="padding-left: 10em"><?php echo $visitedLogActivityInPercentage?>%</td>
                </tr>
                <tr>
                    <td>index.php?page=adminPanel&adminPage=pollResult</td>
                    <td style="padding-left: 10em"><?php echo $visitedPollResultsInPercentage?>%</td>
                </tr>
                <tr>
                    <td>index.php?page=adminPanel&adminPage=products</td>
                    <td style="padding-left: 10em"><?php echo $visitedProductsInPercentage?>%</td>
                </tr>
                <tr>
                    <td>index.php?page=adminPanel&adminPage=users</td>
                    <td style="padding-left: 10em"><?php echo $visitedUsersInPercentage?>%</td>
                </tr>
                <tr>
                    <td>index.php?page=adminPanel&adminPage=updateProduct</td>
                    <td style="padding-left: 10em"><?php echo $visitedUpdateProductInPercentage?>%</td>
                </tr>
            </tbody>
        </table>
    <?php
        global $conn;
        $currentDateTime  = strtotime(date("d.m.Y H:i:s"));
        $currentDay = $currentDateTime-(24*60*60);
        $query = "SELECT COUNT(*) as number FROM users WHERE lastTimeLoggedIn<$currentDateTime AND lastTimeloggedIn>$currentDay";
        $number = $conn->query($query)->fetchAll();
    echo ("<h2 class='mt-5'>Number of users that was logged in today: ".$number[0]->number."</h2>");

    ?>
    <table id="champTable" >
        <thead id="tableHead">
        <tr>
            <th>IP Adress</th>
            <th>Username</th>
            <th>Page</th>
            <th>Date and time</th>
        </tr>
        </thead>
        <tbody id="tableBody">

        <?php
        $logFile=file("log.txt");
        if(count($logFile)>0){
            foreach ($logFile as $log){
                $oneLogValues = explode("\t",$log);
                echo("<tr class='dataRows'>
                <td>$oneLogValues[0]</td>
                <td>$oneLogValues[1]</td>
                <td>$oneLogValues[2]</td>
                <td>$oneLogValues[3]</td>
            </tr>");
            }
        }
        else{
            echo("<tr><td>No activities found</td></tr>");
        }
        ?>

        </tbody>
    </table>
</div>