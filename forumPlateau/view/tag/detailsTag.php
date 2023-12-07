<?php
use Service\ConvertDate;
$topics = $result['data']['topics'];
$tag = $result['data']['tag'];

?>   

<?php if($tag) { ?>

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
            <th class="author">Author</th>
            <th class="tableTitle">Topics</th>
            <th>Date</th>
            <th>Messages</th>
        </tr>

    </thead>
    
    <tbody class="blocDetailsTag">

        <?php foreach($topics as $topic) { ?>

            <tr>

                <td class="authorTopic">
                    <a href="index.php?ctrl=user&action=detailsUserProfile&id=<?= $topic->getUser()->getId() ?>">
                        <?= $topic->getUser()->showPicture() ?><?= $topic->getUser()->getUsername() ?>
                    </a>
                </td>

                <td>
                    <a href="index.php?ctrl=message&action=showMessages&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a>
                </td>

                <td class="timeInterval">
                    <?= ConvertDate::convertDate($topic->getCreationDate()) ?>
                </td>

                <td>
                    <?= $topic->getNbMessages() ?><span class="show-phone">&nbsp;messages</span>
                </td>

            </tr>

        <?php } ?>

    </tbody>

</table>
