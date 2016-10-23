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
      <li><a href="#">Criminal Records</a></li>
      <li><a href="#">About</a></li>
      <li style="float:right"><a href="http://localhost:80/index.html">Logout</a></li>
      <li style="float:right"><a href="#">Enter new record</a></li>
    </ul>
    <div id="id"> 
    Batch ID: 
    <?php   
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
    <form>
      <input type="text" class="search" name="search" placeholder="Search..">
    </form>
    <form method="get" action="searched_log.php">
   	 <button class="button">C - Dex Search</button>
    </form>
  </div>
</body>
</html>
