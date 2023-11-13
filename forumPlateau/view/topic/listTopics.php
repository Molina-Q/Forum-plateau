<?php
use Model\ConvertDate;
$topics = $result["data"]['topics'];
    
?>

<h1>Every Topics</h1>
<table>
    <thead>
        <tr>
            <th colspan="2">Topics</th>
            <th>Tag</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody class="blocListTopics">
<?php
foreach($topics as $topic){
?>
    <tr>
        <td>
            <a href="index.php?ctrl=user&action=">
                <?= $topic->getUser()->getUsername() ?>
            </a>
        </td>

        <td>
            <a href="index.php?ctrl=message&action=showMessages&id=<?= $topic->getId() ?>">
                <?= $topic->getTitle() ?>
            </a>
        </td>

        <td>
            <a href="index.php?ctrl=tag&action=detailsTag&id=<?= $topic->getTag()->getId() ?>">
                <?= $topic->getTag()->getLabel() ?>
            </a>
        </td>

        <td class="timeInterval">
            <?= ConvertDate::convertDate($topic->getCreationDate()) ?>
        </td>
    </tr>
<?php
}
?>
    </tbody>
</table>

  
