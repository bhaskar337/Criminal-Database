<?php   
session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
  <title>Crime Index</title>
  <link rel="stylesheet" type="text/css" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Allerta|Nunito" rel="stylesheet">

</head>
<body>

  <div class="navbar">
    <ul>
      <li><a id="active" href="">Home</a></li>
      <li><a href="records_log.php">Criminal Records</a></li>
      <li><a href="#">About</a></li>
      <li style="float:right"><a href="index.html">Logout</a></li>
      <li style="float:right"><a href="enterRecord.php">Enter new record</a></li>
    </ul>
    <div id="id"> 
    Batch ID: 
    <?php   
     if (!isset($_SESSION["id"])){
        header("Location: http://localhost:80/index.html");
        exit();
      }
    echo $_SESSION["id"];
    ?>
    </div>
  </div>

  <div class="name">
    <p id="c">C</p>
    <p id="rime-in">rime-In</p>
    <p id="dex">Dex</p>
  </div>
  <div class="find">
    <form method="get" action="search_name_log.php">
    <div>
      <input type="text" class="search" name="search" placeholder="Search..">
    </div>
    <div>
       <button type="submit" class="button">C - Dex Search</button>
    </div>
    </form>
  </div>
</body>
</html>
