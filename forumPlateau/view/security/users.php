<?php
use Service\ConvertDate;
use App\Session;
$users = $result["data"]['users'];
    
?>

<h1>Every user</h1>
<table id="table-users">
    <thead>
        <tr>
            <th class="tableTitle" colspan="2">Username</th>

            <?php if(Session::isAdmin()) { ?>
                <th>Email</th>
            <?php } ?>

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
                    <a href="index.php?ctrl=user&action=detailsUserProfile&id=<?= $user->getId() ?>">
                        <?= $user->getUsername() ?>
                    </a>
                </td>

                <?php if(Session::isAdmin()) { ?>
                    <td>
                        <?= $user->getEmail() ?>
                    </td>
                <?php } ?>

                <td>
                    <?= $user->getRole() ?>
                </td>

                <td>
                    <?= $user->getFormattedDate("Y/m/d") ?>
                </td>

            </tr>
        <?php } ?>
    </tbody>
</table>