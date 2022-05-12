<?php 
session_start();
var_dump($_SESSION);
include 'database_infos.php';
echo '</br>';
var_dump($_POST);
echo '</br>';
$id=$_SESSION["id"];
$sha256=hash('sha256', $_POST['password']);
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$changeNbr=$conn->exec("UPDATE players SET password='$sha256' WHERE id='$id'");
echo '</br>';
var_dump($changeNbr);
$_SESSION["connected"]=true;
$server_host=$_SERVER['SERVER_ADDR'];
header('Location: http://'.$server_host.'/tirage.php');