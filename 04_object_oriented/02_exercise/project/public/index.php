<?php
// Error reporting
error_reporting(-1);
ini_set("display_errors", "On");

// Autoload
require ("../autoload.php");
/*
spl_autoload_register(function($value){
    $value = "../src/" . str_replace("\\", "/", $value) . '.php';
    require $value;
});
*/
// Setup directory config

Config\Directory::set("../");

echo Config\Directory::storage();
echo "<br/>";

// App example
$app = new App();
$app->run();
