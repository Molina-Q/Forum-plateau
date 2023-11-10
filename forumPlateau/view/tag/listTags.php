<?php

$tags = $result["data"]['tags'];
    
?>

<h1>Every Tags</h1>
<table>
    <thead>
        <tr>
            <th>Tags</th>
            <th>Icon</th>
            <th>Description</th>
            <th>Topics</th>
        </tr>
    </thead>

    <tbody class="blocListTags">
<?php
foreach($tags as $tag){
?>
    <tr>
        <td>
            <a href="index.php?ctrl=message&action=showMessages&id=<?= $tag->getId() ?>">
                <?= $tag->getLabel() ?>
            </a>
        </td>

        <td>
            <i class="fa-solid fa-circle" style="color:<?= $tag->getIcon() ?>;"></i>
        </td>

        <td>
            <?= $tag->getDescription() ?>
        </td>

        <td>
            nb Topics
        </td>

    </tr>
<?php
}
?>
    </tbody>
</table>

  