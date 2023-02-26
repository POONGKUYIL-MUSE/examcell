<?php

error_reporting(E_ERROR);

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'examcell';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    echo "Connection Failed";
    exit();
}
