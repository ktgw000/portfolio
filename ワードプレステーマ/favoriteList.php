<?php
session_start();
$test = $_POST["number"];
$sample = $test + 100;
$_SESSION['sample'] = $sample;
echo json_encode($sample); 
?>