<?php 
use App\Session;

if(isset($result["data"]["formErrors"])) { // initialize the variables only if they are set
    $formErrors = $result["data"]["formErrors"];
}

$message = $result["data"]["message"];

?>

<?php if($message) { ?>

    <div id="form-container">
        <div id="form-header">
            <h1>Update a message</h1>
        </div>

        <form id="form-content" action="index.php?ctrl=message&action=updateMessage&id=<?= $message->getId() ?>" method="post">
            <!-- text -->
            <label for="text">Message</label>
            <textarea name="text" id="text" cols="60" rows="5"><?= $message->getText() ?></textarea>
            <?= Session::getFlash("text") ?>

            <button type="submit">submit</button>
        </form>
    </div>

<?php } ?>