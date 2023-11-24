<?php
use Service\ConvertDate;
$users = $result["data"]['users'];
    
?>

<h1>Every user</h1>
<table>
    <thead>
        <tr>
            <th colspan="2">Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Date of creation</th>
        </tr>
    </thead>

    <tbody class="blocListUser">
        <?php foreach($users as $user) { ?>
            <tr>
                <td>
                    <?= $user->showPicture() ?>
                </td>

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
                    <?= $user->getFormattedDate("Y/m/d, H:i:s") ?> - <span class="timeInterval"><?= ConvertDate::convertDate($user->getCreationDate()) ?></span>
                </td>

            </tr>
        <?php } ?>
    </tbody>
</table>