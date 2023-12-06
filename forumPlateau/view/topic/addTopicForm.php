<?php 
use App\Session;

$tags = $result["data"]["tags"];

if(isset($result["data"]["idTag"])) {
    $idTag = $result["data"]["idTag"];
} else {
    $idTag = "";
}

?>

<div id="form-container">

    <div id="form-header">

        <h1>Create a topic</h1>

    </div>
    
    <form id="form-content" action="index.php?ctrl=topic&action=addTopic" method="post">

        <!-- title -->
        <label for="title">Title</label>
        <input id="title" type="text" name="title" value=<?= isset($fieldData) ? $fieldData["title"] : ""//ternary in value to show data previously written ?>>
        <?= Session::getFlash("title") ?>
        
        <!-- tag -->
        <label for="tag">Tag</label>
        <select name="tag" id="tag">

            <?php foreach($tags as $tag) { ?>

                <option value="<?= $tag->getId() ?>" <?= $tag->getId() == $idTag ? "selected" : "" ?>>

                    <?= $tag->getLabel() ?>

                </option>

            <?php  } ?>

        </select>

        <!-- text -->
        <label for="text">Topic's content</label>
        <textarea name="text" id="text" cols="60" rows="5"></textarea>
        <?= Session::getFlash("text") ?>


        <button type="submit">submit</button>

    </form>
    
</div>