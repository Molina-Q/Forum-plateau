<?php

$topics = $result["data"]['topics'];
    
?>

<h1>Every Topics</h1>

<?php foreach($topics as $topic) { ?>
    <p><?= $topic->getTitle() ?></p>
<?php }


  
