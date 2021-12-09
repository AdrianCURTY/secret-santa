<?php
session_start();

include 'database_infos.php';
$id=$_SESSION["id"];
$sha256=hash('sha256', $_POST['password']);
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM players WHERE id='$id' AND password='$sha256';";
$res=$conn->query($sql);
$res->setFetchMode(PDO::FETCH_OBJ);
$USERNAME="NOTFOUND";
$USERPWD="NOTFOUND";
if($res->rowCount() == 1){
    $ligne = $res->fetch();            
$USERNAME=$ligne->name;
$_SESSION["name"]=$USERNAME;
$_SESSION["id"]=$id;
$_SESSION["connected"]=true;
$server_host=$_SERVER['SERVER_ADDR'];
header('Location: http://'.$server_host.'/secret-santa/tirage.php');
}else{
    session_destroy();
    echo "Echec de la connexion <br>";
    echo "<a href=\"\\\">Retourner à l'acceuil </a>";
}

