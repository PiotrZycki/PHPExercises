<?php
require("../view/feed/index.php");
if (isset($userA)) {
    ?>
    <form method="post" action="/feed/store">
        <input type="text" name="postTitle" value="Title">
        <br/>
        <textarea rows="4" cols="50" name="postText">Enter text here...</textarea>
        <br/>
        <input type="submit" value="Publish">
    </form>
<?php
}
?>
