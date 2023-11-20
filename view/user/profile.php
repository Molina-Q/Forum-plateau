<?php 
$topics = $result["data"]["topics"];
?>

<div id="form-register-container">
    <div id="form-register-header">
        <h1>Profile</h1>
    </div>

    <div id="form-register" action="index.php?ctrl=security&action=registerUser" method="post">
        <p>Username : <span><?= $_SESSION["user"]->getUsername() ?></span></p>
        <p>Email : <span><?= $_SESSION["user"]->getEmail() ?></span></p>
        <p>Role : <span><?= $_SESSION["user"]->getRole() ?></span></p>

        <h2>My Topics:</h2>

        <?php if(isset($topics)) {
            foreach($topics as $topic) { ?>
                <ul><?= $topic->getTitle() ?> 
                    <li><?= $topic->getTag()->showIcon() ?><?= $topic->getTag()->getLabel() ?></li>
                    <li><?= $topic->getFormattedDate() ?></li>
                </ul> 
            <?php }
        } else { ?>
            <li>You haven't posted any topics</li>
        <?php } ?>


    </div>


</div>