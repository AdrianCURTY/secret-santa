<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<style>
    body{
        background-image:  url("assets/background.jpg");
    }
    #card-container{
        margin-top:15%;
      margin-right:30%;
      margin-left:30%;
      
      /* max-width:25%; */
    }
    #chat-container { background: white; display:flex;
      bottom: 0;
    position: fixed;
      flex-direction:column; 
      max-height:35%;
      margin: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; }

#form { background: rgba(0, 0, 0, 0.15); padding: 0.25rem; bottom: 0; left: 0; right: 0; display: flex; height: 3rem; box-sizing: border-box; backdrop-filter: blur(10px); }
#input { border: none; padding: 0 1rem; flex-grow: 1; border-radius: 2rem; margin: 0.25rem; }
#input:focus { outline: none; }
#form > button { background: #333; border: none; padding: 0 1rem; margin: 0.25rem; border-radius: 3px; outline: none; color: #fff; }

#messages { list-style-type: none; margin: 0; padding: 0; overflow:auto}
#messages > li { padding: 0.5rem 1rem; }
#messages > li:nth-child(odd) { background: #efefef; }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
  <?php session_start(); ?>
  <?php if( !$_SESSION["connected"]): ?>
  <?php  session_destroy();
    echo "Echec de la connexion <br>";
    echo "<a href=\"\\\">Retourner à l'acceuil </a>"; ?>
<?php else: ?>
<?php

$_SESSION["connected"]=true;

include 'system/database_infos.php';


$id=$_SESSION["id"];
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    $sql = "SELECT * FROM players WHERE id=$id;";
    echo "</br> $sql </br>";
    $res=$conn->query($sql);
    $res->setFetchMode(PDO::FETCH_OBJ);
$USERNAME="NOTFOUND";
$USERPWD="NOTFOUND";
$ligne = $res->fetch();           
$USERNAME=$ligne->name;
$PICKED=$ligne->picked_name;
$_SESSION["name"]=$USERNAME;
?>
    <div id="card-container">
    <div class="card text-center">
        
        <div class="card-body">
          <h5 class="card-title"><?php echo ''.$USERNAME.', '; ?>tu as tiré : </h5>
          <h2><?php echo "$PICKED"; ?></h2>
        </div>
        
      </div>
    </div>
    <?php endif ?>
    <style>
     
    </style>
<div id="chat-container">
<ul id="messages"></ul>
    <div id="input-container">
    <form id="form" action="">
      <input id="input" autocomplete="off" /><button>Send</button>
      <?php echo '<input disabled  id="sender" type="text" value="'.$USERNAME.'">'?>
    </form>
    </div>
    <script src="http://51.210.254.169:3000/socket.io/socket.io.js"></script>
    <script src="http://51.210.254.169:3000/client.js"></script>
</div>
<body>
</html>
