<?php
$tags = $result["data"]['tags'];
    
?>

<h1>List of Tags</h1>

<table>

    <thead>

        <tr>
            <th class="tableTitle">Tags</th>
            <th>Description</th>
            <th>Topics</th>
        </tr>

    </thead>

    <tbody class="blocListTags">

        <?php foreach($tags as $tag) { ?>

            <tr>

                <td>
                    <a href="index.php?ctrl=tag&action=detailsTag&id=<?= $tag->getId() ?>">
                    <?= $tag->showIcon() ?><?= $tag->getLabel() ?>
                    </a>
                </td>

                <td>
                    <?= $tag->getDesc() ?>
                </td>

                <td>
                    <?= $tag->getNbtopics() ?><span class="show-phone">&nbsp;topics</span>
                </td>

            </tr>

        <?php } ?>

    </tbody>
    
</table>

  