<?php

$tags = $result["data"]['tags'];
    
?>

<h1>List of Tags</h1>
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
            <?= $tag->getNbtopics() ?>
        </td>

    </tr>
<?php
}
?>
    </tbody>
</table>

  