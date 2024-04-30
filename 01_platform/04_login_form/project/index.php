<?php
    session_start();
?>
<html>
<head>

</head>
<body>
<?php
    if(isset($_SESSION["error"])) {
        echo $_SESSION["error"];
    }
    else {
?>
    <form action="login.php" method="post">
        <label for="user">User</label>
        <input type="text" name="user" id="user"><br/>
        <label for="password">Password</label>
        <input type="text" name="password" id="password"><br/>
        <button type="submit" name="submit">Login</button>
    </form>
<?php
    }
    session_destroy();
?>
</body>
</html>


