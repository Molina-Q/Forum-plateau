<?php 
use Service\FieldError;
use App\Session;

$userRole = "";
$topics = $result["data"]["topics"];
$isAdmin = null;
$isUser = null;
$current = "(CURRENT ROLE)";

if(isset($formErrors)) {
    $formErrors = $result["data"]["formErrors"];
}

if(Session::isAdmin()) {
    $isAdmin = "selected";
} else {
    $isUser = "selected";
}

?>

<div id="form-register-container">
    <div id="form-register-header">
        <h1>Profile</h1>
    </div>

    <div id="profile">
        <div id="profile-header">
            <div class="profile-pic">
                <?= $_SESSION["user"]->showPicture() ?>
            </div>

            <div class="profile-info">
                <p>Username</p>
                <p class="username"><?= $_SESSION["user"]->getUsername() ?></p>

                <p>Email</p>
                <p class="email"><?= $_SESSION["user"]->getEmail() ?></p>

                <?php if(Session::isAdmin()) { ?>
                    <form action="index.php?ctrl=user&action=updateUser" method="post">
                        <label for="role">Role</label>
                        <select name="role" id="role">
                            <option value="ROLE_ADMIN" <?= $isAdmin ?>>ADMIN <?= isset($isAdmin) ? $current : "" ?></option>
                            <option value="ROLE_USER" <?= $isUser ?>>USER <?= isset($isUser) ? $current : "" ?></option>
                        </select>

                        <button type="submit">Change</button>
                    </form>
                <?php } ?> 
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Topic posted</th>
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
                <p>You haven't posted any topics</p>
            <?php } ?>

        </table>
        
        <form id="form-content-profile" action="index.php?ctrl=user&action=updateUser" enctype="multipart/form-data" method="post">
            <label for="picture">Upload a picture for your profile!</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="10000"/>
            <input type="file" name="picture" id="picture">
            <?= isset($formErrors["picture"]) ? FieldError::fieldError($formErrors["picture"]) : "" ?>

            <button type="submit">Upload</button>
        </form>

    </div>

</div>