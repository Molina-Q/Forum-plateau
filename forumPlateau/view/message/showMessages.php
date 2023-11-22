<?php
use App\Session;
use Service\ConvertDate;

$messages = $result["data"]['messages'];
$topic = $result["data"]["topic"];
?>


<?php if($topic) { ?>

    <div id="detailsTopicHeader">
        <div id="detailsTopicAuthor">
            <?= $topic->getUser()->showPicture() ?>
            <p><?= $topic->getUser()->getUsername() ?></p>
            <p class="timeInterval"><?= ConvertDate::convertDate($topic->getCreationDate()) ?></p>
        </div>

        <div id="detailsTopicContent">
            <h1><?= $topic->getTitle() ?></h1> <!-- this as h1 because this seems like the most interesting part to be found with google search -->
            <p><?= $topic->getMessageAuthor() ?></p>

            <?php if(isset($_SESSION["user"])) { 
                if($_SESSION["user"]->getId() == $topic->getUser()->getId() || App\Session::isAdmin()) { ?>
                    <a href="index.php?ctrl=topic&action=updateTopicForm&id=<?= $topic->getId() ?>">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                    <a class="deleteIcon" href="index.php?ctrl=topic&action=deleteTopic&id=<?= $topic->getId() ?>">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                    
                <?php }
            } ?>
        </div>

    </div>

<?php } ?>

<?php if(isset($_SESSION["user"])) { ?>
<!-- form to create a message -->
    <form id="form-add-message" action="index.php?ctrl=message&action=addMessage&id=<?= $topic->getId() ?>" method="post">
        <label for="text">Say something</label>
        <textarea name="text" id="text" cols="15" rows="1" placeholder="Write something..."></textarea>
        <button type="submit">Send</button>
    </form>

<?php } else { ?>

    <p class="replaceFormMessage">You need to be registered in order to comment a topic</p>

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
                    <td><?= $message->getFormattedDate("d-m-Y, H:i") ?></td>

                    <?php if((isset($_SESSION["user"])&&($_SESSION["user"]->getId() == $message->getUser()->getId()) || App\Session::isAdmin())) { ?>
                        <td>
                            <a href="index.php?ctrl=message&action=updateMessageForm&id=<?= $message->getId() ?>">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <a class="deleteIcon" href="index.php?ctrl=message&action=deleteMessage&id=<?= $message->getId() ?>">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                    <?php } ?>
                </tr>

            <?php } ?>

        <?php } else { ?> 
            <tr>
                <td colspan="3">There is no responses yet</td>
            </tr> 
        <?php } ?>

    </tbody>
</table>

  
