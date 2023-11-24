<?php 
use Service\FieldError;
if(isset($formErrors)) {
    $formErrors = $result["data"]["formErrors"];
}
?>

<div id="form-container">
    <div id="form-header">
        <h1>Login</h1>
    </div>

    <form id="form-content" action="index.php?ctrl=security&action=loginUser" method="post">
        <!-- email -->
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <?= isset($formErrors["email"]) ? FieldError::fieldError($formErrors["email"]) : "" //ternary to verify if an error is set than shows it ?>

        <!-- password -->
        <div class="form-password">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <i class="fa-solid fa-eye" id="eyeCon"></i>
            <?= isset($formErrors["password"]) ? FieldError::fieldError($formErrors["password"]) : "" ?> 
        </div>
        
        <!-- forgot -->
        <a class="passForgot" href="index.php?ctrl=security&action=changePassword">
            <p>Forgot your password ?</p>
        </a>

        <button type="submit">Connect</button>
    </form>      

</div>