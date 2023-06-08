<?php
    require_once ("models/functions.php");
?>
<div class="col">
    <h1 class="mt-5">Fat losing poll</h1>
    <table id="champTable" >

        <?php
        $answers = selectQuery("fatlosingpoll");
        if(count($answers)): ?>
        <thead id="tableHead">
        <tr>
            <th>Title</th>
            <th>Number of votes</th>
        </tr>
        </thead>
        <tbody id="tableBody">
        <?php foreach ($answers as $answer):?>
            <tr class="dataRows">
                <td><?=$answer->title?></td>
                <td><?=$answer->noOfVotes?></td>
            </tr>
        <?php endforeach;?>
        <?php else:?>
            <h2>There is currently no answers at database</h2>
        <?php endif;?>

        </tbody>
    </table>
</div>