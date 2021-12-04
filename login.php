<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
    </style>
    <title>Document</title>
    
</head>

<body>
<?php
session_start();
session_destroy();
session_start();
include 'system/database_infos.php';
$id=$_POST["id"];
$_SESSION["id"]=$id;
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM players WHERE id=$id;";
    $res=$conn->query($sql);
    $res->setFetchMode(PDO::FETCH_OBJ);
$USERNAME="NOTFOUND";
$USERPWD="NOTFOUND";
$ligne = $res->fetch();            
$USERNAME=$ligne->name;
$USERPWD=$ligne->password;
$_SESSION["name"]=$USERNAME;
?>
<div id="card-container">
    <div class="card text-center">
        
  
  <div class="card-body">
    <h5 class="card-title">Bonjour <?php echo ' '.$USERNAME.''; ?></h5>
    <?php if ($USERPWD == NULL): ?>
        <h5>Prémiére connexion ? Choisis un mot de passe pour acceder à ton tirage  </h5>
    <form id="newPasswordForm" method="post" action="system/create_password.php">
  
    <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php else: ?>
  <h5>Connexion </h5>
  <form id="password" method="post" action="system/auth.php">
  
  <div class="form-group">
  <label for="exampleInputPassword1">Password</label>
  <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
</div>
<button type="submit" class="btn btn-primary">Connexion</button>
</form>

<?php endif ?>
  </div>
  
</div>
  </div>
<body>
</htm>
