<?php

use Service\ConvertDate;

$messages = $result["data"]['messages'];
$topic = $result["data"]["topic"];
?>

<!-- <h1>Every messages from a topic</h1> -->

<?php if($topic) { ?>
    <div id="detailsTopicHeader">
        <div id="detailsTopicAuthor">
            <p><?= $topic->getUser()->getUsername() ?></p>
            <p class="timeInterval"><?= ConvertDate::convertDate($topic->getCreationDate()) ?></p>
        </div>

        <div id="detailsTopicContent">
            <h1><?= $topic->getTitle() ?></h1> <!-- this as h1 because this seems like the most interesting part to be found with google search -->
            <p><?= $topic->getMessageAuthor() ?></p>
        </div>
    </div>
<?php } ?>

<table>
    <thead>
        <tr>
            <th>Author</th>
            <th>Responses</th>
            <th>Dates</th>
        </tr>
    </thead>

    <tbody class="blocMsgsFromTopic">
<?php foreach($messages as $message) { ?>
    <tr>
        <td><?= $message->getUser()->getUsername() ?></td>
        <td><?= $message->getText() ?></td>
        <td><?= $message->getFormattedDate("d-m-Y, H:i") ?></td>
    </tr>
<?php } ?>
    </tbody>
</table>

  
