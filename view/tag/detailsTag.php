<?php
use Service\ConvertDate;
$topics = $result['data']['topics'];
$tag = $result['data']['tag'];
    
if($tag) { ?>

    <h1><?= $tag->getLabel() ?></h1>
    <?php if(isset($_SESSION["user"])) { ?>
        <a href="index.php?ctrl=topic&action=addTopicForm&id=<?= $tag->getId() ?>">
            Create a new topic!
            <i class="fa-solid fa-plus"></i>
        </a> 
    <?php } ?>

<?php } ?>

<table>
    <thead>
        <tr>
            <th>Author</th>
            <th>Topics</th>
            <th>Date</th>
            <th>Messages</th>
        </tr>
    </thead>
    
    <tbody class="blocListTags">

<?php foreach($topics as $topic) { ?>
    <tr>
        <td>
            <?= $topic->getUser()->getUsername() ?>
        </td>

        <td>
            <a href="index.php?ctrl=message&action=showMessages&id=<?= $topic->getId() ?>"> <?= $topic->getTitle() ?> </a>
        </td>

        <td class="timeInterval">
            <?= ConvertDate::convertDate($topic->getCreationDate()) ?>
        </td>

        <td>
            <?= $topic->getNbMessages() ?>
        </td>

    </tr>
<?php } ?>
    </tbody>
</table>
