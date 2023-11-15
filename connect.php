<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'adam');
define('DB_PASSWORD', 'adam');
define('DB_NAME', 'sabor_usm');

$link;
try{
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
}catch(Exception $e){
    echo '"ERROR: could not connect. ". mysqli_connect_error()';
    exit();
}
mysqli_select_db($link, DB_NAME);
?>
