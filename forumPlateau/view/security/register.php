<?php 
use Service\FieldError;

if(isset($result["data"])) { // initialize the variables only if they are set
    $fieldData = $result["data"]["fieldData"];
    $formErrors = $result["data"]["formErrors"];
}

?>

<div id="form-register-container">
    <div id="form-register-header">
        <h1>Sign in</h1>
    </div>

    <form id="form-register" action="index.php?ctrl=security&action=registerUser" method="post">
        <!-- username -->
        <label for="username">Username</label>
        <input id="username" type="text" name="username" value=<?= isset($fieldData) ? $fieldData["username"] : ""//ternary in value to show data previously written ?>>
        <?= isset($formErrors["username"]) ? FieldError::fieldError($formErrors["username"]) : "" //ternary to verify if an error is set than shows it ?>

        <!-- email -->
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value=<?= isset($fieldData["email"]) ? $fieldData["email"] : "" ?> >
        <?= isset($formErrors["email"]) ? FieldError::fieldError($formErrors["email"]) : "" ?>

        <!-- confirmEmail -->
        <label for="confirmEmail">Confirm email</label>
        <input type="email" name="confirmEmail" id="confirmEmail">
        <?= isset($formErrors) ? FieldError::fieldError($formErrors["confirmEmail"]) : "" ?>

        <!-- password -->
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <?= isset($formErrors) ? FieldError::fieldError($formErrors["password"]) : "" ?>

        <!-- confirmPassword -->
        <label for="confirmPassword">Confirm password</label>
        <input type="password" name="confirmPassword" id="confirmPassword">
        <?= isset($formErrors) ? FieldError::fieldError($formErrors["confirmPassword"]) : "" ?>

        <button type="submit">Register</button>
    </form>
</div>