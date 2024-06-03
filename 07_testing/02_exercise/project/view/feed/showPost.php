<?php
if (!isset($posts)) {
    exit('The $posts is not set!');
}
require("../view/feed/index.php");
?>
<?php foreach ($posts as $post) {
    if($post instanceof \Model\Post) { ?>
        <p><?php $post->drawPost() ?></p>
    <?php }
    } ?>