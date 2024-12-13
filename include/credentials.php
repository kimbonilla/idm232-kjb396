<?php
    $host = 'localhost';
    $user = 'kjb396';
    $password = 'cYyYANESYT6wrGAY';
    $database = 'kjb396_db';
    $connection = mysqli_connect($host, $user, $password, $database);
    if (!$connection) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    //Encode to UTF-8
    function convertToUTF8($str) {
        return mb_convert_encoding($str, 'UTF-8', 'ISO-8859-1');
    }
?>