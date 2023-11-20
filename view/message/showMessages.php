<?php
use App\Session;
use Service\ConvertDate;

$messages = $result["data"]['messages'];
$topic = $result["data"]["topic"];
?>


<?php if($topic) { ?>

    <div id="detailsTopicHeader">
        <div id="detailsTopicAuthor">
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
                <?php }
            } ?>
        </div>
    </div>

<?php } ?>

<?php if(isset($_SESSION["user"])) { ?>
<!-- form to create a message -->
    <form id="form-add-message" action="index.php?ctrl=message&action=addMessage&id=<?= $topic->getId() ?>" method="post">
        <label for="text">Say something</label>
        <textarea name="text" id="text" cols="30" rows="5" placeholder="Write something..."></textarea>
        <button type="submit">Send</button>
    </form>

<?php } else { ?>

    <p class="replaceFormMessage">You need to be registered in order to comment a topic</p>

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
        <?php if(isset($messages)) {
            foreach($messages as $message) { ?>
                <tr>
                    <td><?= $message->getUser()->getUsername() ?></td>
                    <td><?= $message->getText() ?></td>
                    <td><?= $message->getFormattedDate("d-m-Y, H:i") ?></td>
                </tr>
            <?php } 

        } else { ?> 
            <tr>
                <td colspan="3">There is no responses yet</td>
            </tr> 
        <?php } ?>

    </tbody>
</table>

  
