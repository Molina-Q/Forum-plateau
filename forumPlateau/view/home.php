<?php

use Service\ConvertDate;
use App\Session;

$topics = $result["data"]["topics"];
$tags = $result["data"]["tags"];

$statUsers = $result["data"]["statUsers"];    
$statMessages = $result["data"]["statMessages"];    
$statTopics = $result["data"]["statTopics"];

$recentsTopic = $result["data"]["recents"];    
?>

<?php if(Session::isAdmin()) { ?>

    <h1>Welcome ADMIN-<?= $_SESSION["user"]->getUsername() ?></h1>

<?php } else if(Session::getUser()) { ?>

    <h1>Welcome <?= $_SESSION["user"]->getUsername() ?></h1>

<?php } else { ?>

    <h1>Welcome to this forum!</h1>

<?php } ?>

<div id="homePageContent" class="grid-container">
    <div id="homePage-left">
        <div id="popularTopics" class="grid-item">
            <table>
                <thead>
                    <tr>
                        <th class="author">Author</th>
                        <th>Popular topic</th>
                        <th>Date</th>
                        <th>Post</th>
                        <th>Tag</th>
                    </tr>
                </thead>

                <tbody class="blocListPopular">
                    <?php foreach($topics as $topic) { ?>
                        <tr>
                            <td class="authorTopic">
                                <?= $topic->getUser()->showPicture() ?><?= $topic->getUser()->getUsername() ?>
                            </td>

                            <td>
                                <a href="index.php?ctrl=message&action=showMessages&id=<?= $topic->getId()?>">
                                    <?= $topic->getTitle() ?>
                                </a>
                            </td>

                            <td class="timeInterval">
                                <?= ConvertDate::convertDate($topic->getCreationDate()) ?>
                            </td>
        
                            <td>
                                <?= $topic->getNbMessages() ?> 
                            </td>

                            <td>
                                <a href="index.php?ctrl=tag&action=detailsTag&id=<?= $topic->getTag()->getId() ?>">
                                    <?= $topic->getTag()->showIcon() ?><?= $topic->getTag()->getLabel() ?>
                                </a>
                            </td>
                            
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    
        <div id="popularTags" class="grid-item">
            <table>
                <thead>
                    <tr>
                        <th>Popular tags</th>
                        <th>Icon</th>
                        <th>Description</th>
                        <th>Topics</th>
                    </tr>
                </thead>

                <tbody class="blocListTags">
                    <?php foreach($tags as $tag) { ?>
                        <tr>
                            <td>
                                <a href="index.php?ctrl=tag&action=detailsTag&id=<?= $tag->getId() ?>">
                                    <?= $tag->getLabel() ?>
                                </a>
                            </td>

                            <td>
                                <?= $tag->showIcon() ?>
                            </td>

                            <td>
                                <?= $tag->getDesc() ?>
                            </td>

                            <td>
                                <?= $tag->getNbTopics() ?>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="homePage-right">
        <div id="statistics" class="grid-item">
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Statistics</th>
                    </tr>
                </thead>

                <tbody class="blocListStat">
                    <tr>
                        <td>Registered User</td>

                        <td>
                            <?php foreach($statUsers as $stat) { 
                                echo $stat->getCountIteration();
                            } ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Topics Written</td>

                        <td>
                            <?php foreach($statTopics as $stat) { 
                                echo $stat->getCountIteration();
                            } ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Messages Sent</td>
                        
                        <td>
                            <?php foreach($statMessages as $stat) {
                                echo $stat->getCountIteration();
                            } ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="recentTopics" class="grid-item">
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Recent topics</th>
                    </tr>
                </thead>

                <tbody class="blocListRecent">
                    <?php foreach($recentsTopic as $topic) { ?>
                        <tr>
                            <td>
                                <a href="index.php?ctrl=tag&action=detailsTag&id=<?= $topic->getTag()->getId() ?>">
                                    <?= $topic->getTag()->showIcon() ?>
                                </a>
                            </td>

                            <td>
                                <a href="index.php?ctrl=message&action=showMessages&id=<?= $topic->getId() ?>">
                                    <?= $topic->getTitle() ?>
                                </a>
                                <span class="timeInterval">
                                    - <?= ConvertDate::convertDate($topic->getCreationDate()) ?>
                                </span>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
