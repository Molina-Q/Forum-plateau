<?php 


?>

<div id="form-login-container">
    <div id="form-login-header">
        <h1>Login</h1>
    </div>

    <form id="form-login" action="index.php?ctrl=security&action=registerUser" method="post">
        <label for="username">Username</label>
        <input type="text" id="username">

        <label for="password">Password</label>
        <input type="password" id="password">

        <button type="submit">Connect</button>
    </form>
</div>