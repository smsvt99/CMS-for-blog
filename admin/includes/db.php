<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$connection = mysqli_connect('localhost', 'root', 'root','cms');
// if($connection) {
//     echo "we are connected";
// }
?> 
