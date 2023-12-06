<?php 
use App\Session;

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
            <input id="title" type="title" name="title" value="<?= $topic->getTitle() ?>">
            <?= Session::getFlash("title") ?>

            <!-- text -->
            <label for="text">Topic's content</label>
            <textarea name="text" id="text" cols="60" rows="5"><?= $topic->getMessageAuthor() ?></textarea>
            <?= Session::getFlash("text") ?>

            <button type="submit">submit</button>
        </form>
        
    </div>

<?php } ?>