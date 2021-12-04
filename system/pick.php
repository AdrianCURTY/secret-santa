<?php

include 'database_infos.php';

    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM players WHERE name='Frédéric' OR name='Martin';";
    $res=$conn->query($sql);
    $res->setFetchMode(PDO::FETCH_OBJ);
    while( $ligne = $res->fetch() ) // on récupère la liste des membres
{
        echo 'Utilisateur : '.$ligne->name.' picked '.$ligne->picked_name.'<br />'; // on affiche les membres
}
$res->closeCursor(); // on ferme le curseur des résultats
