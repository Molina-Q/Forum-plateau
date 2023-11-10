<?php
$topics = $result["data"]["topics"];
    
    
?>

<h1>BIENVENUE SUR LE FORUM</h1>

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ut nemo quia voluptas numquam, itaque ipsa soluta ratione eum temporibus aliquid, facere rerum in laborum debitis labore aliquam ullam cumque.</p>
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
    <?php
    foreach($topics as $topic) {
    ?>
    <tr>
        <td>
            <a href="index.php?ctrl=user&action=">
                <?= $topic->getTitle() ?>
            </a>
        </td>

        <td>
            <a href="index.php?ctrl=message&action=showMessages&id=<?= $topic->getId() ?>">
                nb msg
            </a>
        </td>

        <td>
            <a href="index.php?ctrl=tag&action=detailsTag&id=<?= $topic->getTag()->getId() ?>">
                <?= $topic->getTag()->getLabel() ?>
            </a>
        </td>

        <td>
            <?= $topic->getUser()->getUsername() ?>
        </td>

        <td>
            <?= $topic->getCreationDate() ?>
        </td>
    </tr>
    <?php
    }
    ?>
    </tbody>
</table>
