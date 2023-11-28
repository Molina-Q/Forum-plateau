<?php
use App\Session;
use Service\ConvertDate;
use Service\FieldError;

$messages = $result["data"]['messages'];
$topic = $result["data"]["topic"];
$userSession = Session::getUser();
$closedData = $result["data"]["closed"];

if ($closedData->getClosed() == "true") {
    $closed = true;
} else {
    $closed = false;
}

?>

<?php if($topic) { ?>

    <div id="detailsTopicHeader">

        <?php if($userSession) { ?>

            <?php if(($userSession->getId() == $topic->getUser()->getId() && !$closed) || Session::isAdmin()) { ?>

                <div class="icons">

                    <a href="index.php?ctrl=topic&action=updateTopicForm&id=<?= $topic->getId() ?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>

                    <a class="deleteIcon" href="index.php?ctrl=topic&action=deleteTopic&id=<?= $topic->getId() ?>">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>

                    <?php if(Session::isAdmin() && !$closed) { ?>
                        <a href="index.php?ctrl=topic&action=closeTopic&id=<?= $topic->getId() ?>">
                            <i class="fa-solid fa-lock"></i>
                        </a>
                    <?php } ?>

                    <?php if(Session::isAdmin() && $closed) { ?>
                        <a href="index.php?ctrl=topic&action=openTopic&id=<?= $topic->getId() ?>">
                            <i class="fa-solid fa-lock-open"></i>
                        </a>
                    <?php } ?>
        
                </div>

            <?php } ?>

        <?php } ?>

        <div id="detailsTopicAuthor">

            <?= $topic->getUser()->showPicture() ?>
            <p><?= $topic->getUser()->getUsername() ?></p>
            <p class="timeInterval"><?= ConvertDate::convertDate($topic->getCreationDate()) ?></p>

        </div>

        <div id="detailsTopicContent">

            <?php if($closed) { ?>
                <strong>This topic is locked</strong>
            <?php } ?>

            <h1><?= $topic->getTitle() ?></h1> <!-- this as h1 because this seems like the most interesting part to be found with google search -->
            <p><?= $topic->getMessageAuthor() ?></p>

        </div>

    </div>

<?php } ?>

<?php if(Session::getUser() && !$closed) { ?>
<!-- form to create a message -->
    <form id="form-add-message" action="index.php?ctrl=message&action=addMessage&id=<?= $topic->getId() ?>" method="post">
        <label for="text">Say something</label>
        <textarea name="text" id="text" cols="15" rows="1" placeholder="Write something..."></textarea>
        <button type="submit">Send</button>
        <?= Session::getFlash("text") ?>
    </form>

<?php } else if($closed) { ?>

    <p class="replaceFormMessage">This topic has been locked, you cannot comment.</p>


<?php } else { ?>

    <p class="replaceFormMessage">You need to be registered in order to comment a topic.</p>

<?php } ?>

<table>
    <thead>
        <tr>
            <th class="author">Author</th>
            <th>Responses</th>
            <th colspan="2">Dates</th>
        </tr>
    </thead>

    <tbody class="blocMsgsFromTopic">
        <?php if(isset($messages)) { ?>
            <?php foreach($messages as $message) { ?>

                <tr>
                    <td class="authorTopic"><?= $message->getUser()->showPicture() ?><?= $message->getUser()->getUsername() ?></td>
                    <td><?= $message->getText() ?></td>
                    <td><?= ConvertDate::convertDate($message->getCreationDate()) ?></td>

                    <td>
                        <?php if((isset($_SESSION["user"])&&($_SESSION["user"]->getId() == $message->getUser()->getId()) || Session::isAdmin())) { ?>
                            <a href="index.php?ctrl=message&action=updateMessageForm&id=<?= $message->getId() ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>

                            <a class="deleteIcon" href="index.php?ctrl=message&action=deleteMessage&id=<?= $message->getId() ?>">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        <?php } ?>
                    </td>
                </tr>

            <?php } ?>

        <?php } else { ?> 
            <tr>
                <td colspan="3">There are no responses yet</td>
            </tr> 
        <?php } ?>

    </tbody>
</table>

  
