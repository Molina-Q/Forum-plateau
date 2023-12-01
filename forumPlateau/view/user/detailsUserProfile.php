<?php 
use App\Session;

$topics = $result["data"]["topics"];
$user = $result["data"]["user"];

$userRole = "";
$isAdmin = null;
$isUser = null;

$current = "(CURRENT ROLE)";

if(Session::isAdmin()) {
    $isAdmin = "selected";
} else {
    $isUser = "selected";
}

?>

<div id="form-register-container">

    <?php if($user) { ?>

        <div id="form-register-header">
            <h1><?= $user->getUsername() ?> Profile</h1>
        </div>
        
        <div id="profile">
            
            <div id="profile-header">

                <div class="profile-pic">
                    <?= $user->showPicture() ?>
                </div>

                <div class="profile-info">

                    <p>Username</p>
                    <p class="username"><?= $user->getUsername() ?></p>

                    <?php if(Session::isAdmin()) { ?>

                        <form action="index.php?ctrl=user&action=updateUser" method="post">
                            <label for="role">Role</label>
                            <select name="role" id="role">
                                <option value="ROLE_ADMIN" <?= $user->getRole() == "ROLE_ADMIN" ? "selected" : "" ?> >ADMIN</option>
                                <option value="ROLE_USER" <?= $user->getRole() == "ROLE_USER" ? "selected" : "" ?> >USER</option>
                            </select>

                            <button type="submit">Change</button>
                        </form>

                    <?php } ?> 

                </div>

            </div>

            <table>

                <thead>
                    <tr>
                        <th class="tableTitle">Topic posted</th>
                        <th>Tag</th>
                        <th>messages</th>
                        <th>date</th>
                    </tr>
                </thead>

                <?php if(isset($topics)) { ?>

                    <tbody>

                        <?php foreach($topics as $topic) { ?>

                            <tr>
                                <td>
                                    <a href="index.php?ctrl=message&action=showMessages&id=<?= $topic->getId() ?>">
                                        <?= $topic->getTitle() ?>
                                    </a>
                                </td>
                                
                                <td>
                                    <a href="index.php?ctrl=message&action=showMessages&id=<?= $topic->getId() ?>">
                                        <?= $topic->getTag()->showIcon() ?><?= $topic->getTag()->getLabel() ?>
                                    </a>
                                </td>

                                <td><?= $topic->getNbMessages() ?></td>
                                <td><?= $topic->getFormattedDate("Y-m-d") ?></td>
                            </tr>

                        <?php } ?>

                    </tbody>

                <?php } else { ?>
                    <tr>
                        <td colspan="4">That user hasn't posted any topics</td>
                    </tr>
                <?php } ?>

            </table>

        </div>

    <?php } ?>

</div>