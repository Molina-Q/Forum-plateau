<?php

namespace Service;

abstract class FieldError {

    public static function fieldError($errors) { ?> 
    <p class="error"><?= $errors ?></p> <?php      

    }
}