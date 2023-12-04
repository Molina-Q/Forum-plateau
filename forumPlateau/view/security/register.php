<?php 
use App\Session;

?>

<div id="form-container">
    <div id="form-header">
        <h1>Sign in</h1>
    </div>

    <form id="form-content" action="index.php?ctrl=security&action=registerUser" method="post">
        <!-- username -->
        <div class="form-username">
            <label for="username">Username</label>
            <input type="text" name="username"  id="username" value=<?= isset($fieldData) ? $fieldData["username"] : ""//ternary in value to show data previously written ?>>
            <?= Session::getFlash("username") ?>
        </div>

        <!-- email -->
        <div class="form-email">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value=<?= isset($fieldData["email"]) ? $fieldData["email"] : "" ?> >
            <?= Session::getFlash("email") ?>
        </div>

        <!-- confirmEmail -->
        <div class="form-confirm">
            <label for="confirmEmail">Confirm email</label>
            <input type="email" name="confirmEmail" id="confirmEmail">
            <?= Session::getFlash("confirmEmail") ?>
        </div>

        <!-- password -->
        <div class="form-password">
            <label for="password">Password*</label>
            <input type="password" name="password" id="password">
            <i class="fa-solid fa-eye" id="eyeCon"></i>
        </div>
        <?= Session::getFlash("password") ?>


        <!-- confirmPassword -->
        <div class="form-confirm">
            <label for="confirmPassword">Confirm password</label>
            <input type="password" name="confirmPassword" id="confirmPassword">
            <?= Session::getFlash("confirmPassword") ?>
        </div>
            
        <button type="submit">Register</button>

        <small>*Password must have at least 1 Capital - 1 lowercase - 1 number - 1 special char(@$*#-!?) & minimum 10 characters</small>
    </form>
</div>