<?php 


?>

<div id="form-container">
    <div id="form-header">
        <h1>Change password</h1>
    </div>

    <form id="form-content" action="index.php?ctrl=security&action=changePasswordUser" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">

        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="password">New password</label>
        <input type="password" name="password" id="password">

        <label for="confirmPassword">Confirm new password</label>
        <input type="password" name="confirmPassword" id="confirmPassword">

        <button type="submit">Connect</button>
    </form>
</div>