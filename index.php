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
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
<?php  
include 'system/database_infos.php';
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM players;";
    $res=$conn->query($sql);
    $res->setFetchMode(PDO::FETCH_OBJ);
    
?>
    <div id="card-container">
    <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Sélectionne ton nom dans la liste ci-dessous </h5>
        <form method="post" action="login.php" id="nameForm">
        
              <div class="form-group">
                <select name="id" id="name-selector" form="nameForm" class="form-control selectpicker ">
                  <?php
                  while( $ligne = $res->fetch() )
                  {
                          echo '<option value="'.$ligne->id.'">'.$ligne->name.'</option>'; 
                  }
                  ?>
                </select>
                <!-- <input name="hidden" value="hiddenvalue" hidden> -->
              </div>
            <button type="submit" class="btn btn-primary">Voir mon tirage</button>
          </form>
        </div>
        
      </div>
    </div>
</body>
</html>