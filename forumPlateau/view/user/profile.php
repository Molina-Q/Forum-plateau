<?php 

?>

<div id="form-register-container">
    <div id="form-register-header">
        <h1>Profile</h1>
    </div>

    <form id="form-register" action="index.php?ctrl=security&action=registerUser" method="post">
        <p>Username : <span><?= $_SESSION["user"]->getUsername() ?></span></p>
        <p>Email : <span><?= $_SESSION["user"]->getEmail() ?></span></p>
        <p>Role : <span><?= $_SESSION["user"]->getRole() ?></span></p>
    </form>
</div>