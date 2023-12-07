<?php 
use App\Session;
?>

<div id="errorPage">
    <p>There was a mistake</p>
    
    <?= Session::getFlash("wrongPage") ?>
    
    <p class="error">Error: This page does not exist</p>
</div>


