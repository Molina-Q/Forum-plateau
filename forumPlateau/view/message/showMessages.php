<?php
$messages = $result["data"]['messages'];
$topic = $result["data"]["topic"];
    
?>

<h1>Every messages from a topic</h1>

<?php
if($topic) {
?>
    <h2>Topic is: <?= $topic->getTitle() ?> </h2>
<?php
}
?>
<table>
    <thead>
        <tr>
        <th colspan="2">Responses</th>
        <th>Dates</th>
        </tr>
    </thead>

    <tbody class="blocMsgsFromTopic">
<?php
foreach($messages as $message){
?>
    <tr>
        <td><?= $message->getUser()->getUsername() ?></td>
        <td><?= $message->getText() ?></td>
        <td><?= $message->getCreationDate() ?></td>
    </tr>
<?php
}
?>
    </tbody>
</table>

  
