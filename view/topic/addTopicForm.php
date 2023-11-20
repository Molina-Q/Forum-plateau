<?php 
use Service\FieldError;

if(isset($result["data"]["fieldData"])&&isset($result["data"]["formErrors"])) { // initialize the variables only if they are set
    $fieldData = $result["data"]["fieldData"];
    $formErrors = $result["data"]["formErrors"];
}

$tags = $result["data"]["tags"];
$idTag = $result["data"]["idTag"];
?>

<div id="form-container">
    <div id="form-header">
        <h1>Create a topic</h1>
    </div>
    
    <form id="form-content" action="index.php?ctrl=topic&action=addTopic" method="post">
        <!-- title -->
        <label for="title">Title</label>
        <input id="title" type="text" name="title" value=<?= isset($fieldData) ? $fieldData["title"] : ""//ternary in value to show data previously written ?>>
        <?= isset($formErrors["title"]) ? FieldError::fieldError($formErrors["title"]) : "" //ternary to verify if an error is set than shows it ?>
        
        <!-- tag -->
        <label for="tag">Tag</label>
        <select name="tag" id="tag">
            <?php foreach($tags as $tag) { ?>
                <option value="<?= $tag->getId() ?>" <?= $tag->getId() == $idTag ? "selected" : "" ?> ><?= $tag->getLabel() ?></option>
            <?php  } ?>
        </select>

        <!-- text -->
        <label for="text">Topic's content</label>
        <textarea name="text" id="text" cols="30" rows="10"></textarea>
        <?= isset($formErrors["text"]) ? FieldError::fieldError($formErrors["text"]) : "" ?>


        <button type="submit">submit</button>
    </form>
</div>