<?php
use App\Session;
use Service\ConvertDate;

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

        <div id="detailsTopicAuthor">

            <?= $topic->getUser()->showPicture() ?>

            <a href="index.php?ctrl=user&action=detailsUserProfile&id=<?=$topic->getUser()->getId() ?>">
                <p><?= $topic->getUser()->getUsername() ?></p>
            </a>

            <p class="timeInterval"><?= ConvertDate::convertDate($topic->getCreationDate()) ?></p>

        </div>

        <div id="detailsTopicContent">

            <?php if($closed) { ?>
                <strong>This topic is locked</strong>
            <?php } ?>

            <h1><?= $topic->getTitle() ?></h1>
            
            <p><?= $topic->getMessageAuthor() ?></p>

        </div>

    </div>

<?php if(Session::getUser() && !$closed) { ?>
<!-- form to create a message -->
    <form id="form-add-message" action="index.php?ctrl=message&action=addMessage&id=<?= $topic->getId() ?>" method="post">
        <label for="text">Say something</label>
        <textarea name="text" id="text" cols="15" rows="1" placeholder="Write something..."></textarea>
        <button type="submit"><i class="fa-solid fa-reply"></i></button>
        <?= Session::getFlash("text") ?>
    </form>
    
<?php } ?>

<?php } else if($closed) { ?>

    <p class="replaceFormMessage">This topic has been locked, you cannot comment.</p>


<?php } else { ?>

    <p class="replaceFormMessage">You need to be registered in order to comment a topic.</p>

<?php } ?>

<table>
    <thead>
        <tr>
            <th class="author">Author</th>
            <th class="tableTitle">Responses</th>
            <th colspan="2">Dates</th>
        </tr>
    </thead>

    <tbody class="blocMsgsFromTopic">
        <?php if(isset($messages)) { ?>
            <?php foreach($messages as $message) { ?>

                <tr>
                    <td class="authorTopic">
                        <a href="index.php?ctrl=user&action=detailsUserProfile&id=<?= $message->getUser()->getId() ?>">
                            <?= $message->getUser()->showPicture() ?><?= $message->getUser()->getUsername() ?>
                        </a>
                    </td>

                    <td><?= $message->getText() ?></td>

                    <td><?= ConvertDate::convertDate($message->getCreationDate()) ?></td>

                    <td>
        
                        <?php if((isset($_SESSION["user"]) && ($_SESSION["user"]->getId() == $message->getUser()->getId()) || Session::isAdmin())) { ?>
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

  
