<?php 
use App\Session;

if(isset($formErrors)) {
    $formErrors = $result["data"]["formErrors"];
}

?>

<div id="form-container">
    <div id="form-header">
        <h1>Change password</h1>
    </div>

    <form id="form-content" action="index.php?ctrl=security&action=changePasswordUser" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <?= Session::getFlash("email") ?>

        <div class="form-password">
            <label for="password">New password*</label>
            <input type="password" name="password" id="password">
            <i class="fa-solid fa-eye" id="eyeCon"></i>
            <?= Session::getFlash("password") ?>
        </div>

        <label for="confirmPassword">Confirm password</label>
        <input type="password" name="confirmPassword" id="confirmPassword">
        <?= Session::getFlash("confirmPassword") ?>

        <button type="submit">Confirm</button>

        <small>*Password must have at least 1 Capital - 1 lowercase - 1 number - 1 special char - minimum 4 chars</small>
    </form>
</div>