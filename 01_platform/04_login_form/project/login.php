<?php
session_start();

if(isset($_POST["submit"])) {
    $user = $_POST["user"];
    $password = $_POST["password"];

    if(empty($user) || empty($password)) {
        $_SESSION["error"] = "EMPTY";
        header("location: index.php");
    }
    elseif($user!="foo" || $password!="foo123") {
        $_SESSION["error"] = "ERROR";
        header("location: index.php");
    }
    else {
        $_SESSION["error"] = "OK";
        header("location: index.php");
    }
}