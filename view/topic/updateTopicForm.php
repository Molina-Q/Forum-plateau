<?php 
use Service\FieldError;

if(isset($result["data"]["formErrors"])) { // initialize the variables only if they are set
    $formErrors = $result["data"]["formErrors"];
}

$topic = $result["data"]["topic"];

?>
<?php if($topic) { ?>

    <div id="form-container">
        <div id="form-header">
            <h1>Update a topic</h1>
        </div>

        <form id="form-content" action="index.php?ctrl=topic&action=updateTopic&id=<?= $topic->getId() ?>" method="post">
            <!-- title -->
            <label for="title">Title</label>
            <input id="title" type="text" name="title" value="<?= $topic->getTitle() ?>">
            <?= isset($formErrors["title"]) ? FieldError::fieldError($formErrors["title"]) : "" //ternary to verify if an error is set then shows it ?>

            <!-- text -->
            <label for="text">Topic's content</label>
            <textarea name="text" id="text" cols="30" rows="10"><?= $topic->getMessageAuthor() ?></textarea>
            <?= isset($formErrors["text"]) ? FieldError::fieldError($formErrors["text"]) : "" ?>

            <button type="submit">submit</button>
        </form>
    </div>

<?php } ?>