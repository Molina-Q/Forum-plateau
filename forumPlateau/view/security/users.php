<?php
use Service\ConvertDate;
$users = $result["data"]['users'];
    
?>

<h1>Every user</h1>
<table>
    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Date of creation</th>
        </tr>
    </thead>

    <tbody class="blocListTopics">
<?php
foreach($users as $user){
?>
    <tr>
        <td>
            <?= $user->getUsername() ?>
        </td>

        <td>
            <?= $user->getEmail() ?>
        </td>

        <td>
            <?= $user->getRole() ?>
        </td>

        <td>
            <?= $user->getFormattedDate("Y/m/d, H:i:s") ?>(<?= ConvertDate::convertDate($user->getCreationDate()) ?>)
        </td>

    </tr>
<?php
}
?>
    </tbody>
</table>