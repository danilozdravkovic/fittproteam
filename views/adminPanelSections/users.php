<?php
    require_once ("models/functions.php");
?>
<div class="col">
    <h1 class="mt-5">Users</h1>
    <table id="champTable">

        <?php
        $users = selectFromTwoTables("users","u","roles","r","roleID","id");
        if(count($users)): ?>
        <thead id="tableHead">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Active</th>
        </tr>
        </thead>
        <tbody id="tableBody">
        <?php foreach ($users as $user):?>
            <tr class="dataRows">
                <td><?=$user->username?></td>
                <td><?=$user->email?></td>
                <td><?=$user->title?></td>
                <td><?php echo checkIfOnSale($user->active)?></td>
            </tr>
        <?php endforeach;?>
        <?php else:?>
            <h2>There is currently no users at database</h2>
        <?php endif;?>

        </tbody>
    </table>
</div>

<?php
function checkIfOnSale($onSale){
    if($onSale){
        return "Active";
    }
    else {
        return "Not active";
    }
}
?>