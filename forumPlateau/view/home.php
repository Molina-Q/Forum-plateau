<?php

use Service\ConvertDate;

$topics = $result["data"]["topics"];
$tags = $result["data"]["tags"];
// $statUsers = $result["data"]["statUsers"];    
$statMessages = $result["data"]["statMessages"];    
$statTopics = $result["data"]["statTopics"];
$recentsTopic = $result["data"]["recents"];    

?>

<h1>Welcome on this forum!</h1>

<div id="homePageContent" class="grid-container">
    <div id="homePage-left">
        <div id="popularTopics" class="grid-item">
            <table>
                <thead>
                    <tr>
                        <th>Popular topics</th>
                        <th>Messages</th>
                        <th>Tags</th>
                        <th>Author</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody class="blocListPopular">
                    <?php foreach($topics as $topic) { ?>
                        <tr>
                            <td>
                                <a href="index.php?ctrl=message&action=showMessages&id=<?= $topic->getId()?>">
                                    <?= $topic->getTitle() ?>
                                </a>
                            </td>

                            <td>
                                <?= $topic->getNbMessages() ?> 
                            </td>

                            <td>
                                <a href="index.php?ctrl=tag&action=detailsTag&id=<?= $topic->getTag()->getId() ?>">
                                    <?= $topic->getTag()->showIcon() ?><?= $topic->getTag()->getLabel() ?>
                                </a>
                            </td>

                            <td>
                                <?= $topic->getUser()->getUsername() ?>
                            </td>

                            <td class="timeInterval">
                                <?= ConvertDate::convertDate($topic->getCreationDate()) ?>
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
                        <td>
                            Registered User
                        </td>

                        <td>
                            WIP
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Topics Written
                        </td>

                        <td>
                        <?php foreach($statMessages as $statM) { 
                            echo $statM->getCountIteration();
                        } ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Messages Sent
                        </td>
                        
                        <td>
                        <?php foreach($statTopics as $statT) {
                            echo $statT->getCountIteration();
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
                    <?php foreach($recentsTopic as $recent) { ?>
                        <tr>
                            <td><?= $recent->getTag()->showIcon() ?></td>
                            <td><?= $recent->getTitle() ?> <span class="timeInterval"><?= ConvertDate::convertDate($recent->getCreationDate()) ?></span></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
