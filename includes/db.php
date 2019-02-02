
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$file_lines = file('../../readme.txt');

$zero = trim($file_lines[0]);
$one = trim($file_lines[1]);
$two = trim($file_lines[2]);
$three = trim($file_lines[3]);

$connection = mysqli_connect($zero, $one, $two, $three);
?>
