<?php 


?>

<div id="form-container">
    <div id="form-header">
        <h1>Login</h1>
    </div>

    <form id="form-content" action="index.php?ctrl=security&action=loginUser" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <button type="submit">Connect</button>
    </form>
</div>