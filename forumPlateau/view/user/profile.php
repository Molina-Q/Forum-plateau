<?php 
use Service\FieldError;

$topics = $result["data"]["topics"];
if(isset($formErrors)) {
    $formErrors = $result["data"]["formErrors"];
    var_dump($formErrors);die;
}
?>

<div id="form-register-container">
    <div id="form-register-header">
        <h1>Profile</h1>
    </div>

    <div id="profile">
        <div id="profile-header">
            <div class="profilePic"><?= $_SESSION["user"]->showPicture() ?></div>
            <p class="username"><?= $_SESSION["user"]->getUsername() ?></p>
            <p class="email"><?= $_SESSION["user"]->getEmail() ?></p>
            <p class="role"><?= $_SESSION["user"]->getRole() ?></p>
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
                        <td><?= $topic->getTitle() ?></td>
                        <td><?= $topic->getTag()->showIcon() ?><?= $topic->getTag()->getLabel() ?></td>
                        <td><?= $topic->getNbMessages() ?></td>
                        <td><?= $topic->getFormattedDate("d-m-Y") ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php } else { ?>
            <li>You haven't posted any topics</li>

        <?php } ?>
        
        <form id="form-content-profile" action="index.php?ctrl=user&action=updateUser" enctype="multipart/form-data" method="post">
            <label for="picture">Upload a picture for your profile!</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="100000"/>
            <input type="file" name="picture" id="picture">
            <?= isset($formErrors["picture"]) ? FieldError::fieldError($formErrors["picture"]) : "" ?>
            <button type="submit">Upload</button>
        </form>


    </div>


</div>