<?php 
use Service\FieldError;
use App\Session;

$topics = $result["data"]["topics"];
?>

<div id="form-register-container">

    <div id="form-register-header">
        <h1>Profile update</h1>
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

                            <td><?= $topic->getNbMessages() ?><span class="show-phone">&nbsp;messages</span></td>
                            <td><?= $topic->getFormattedDate("Y-m-d") ?></td>
                        </tr>

                    <?php } ?>

                </tbody>

            <?php } else { ?>

                <tr>
                    <td colspan="4">You haven't posted any topics</td>
                </tr>

            <?php } ?>

        </table>
        
        <form id="form-content-profile" action="index.php?ctrl=user&action=updateUser" enctype="multipart/form-data" method="post">
            <label for="picture">Upload a picture for your profile!</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="10000"/>
            <input type="file" name="picture" id="picture">
            <?= Session::getFlash("picture") ?>

            <button type="submit">Upload</button>
        </form>

    </div>

</div>