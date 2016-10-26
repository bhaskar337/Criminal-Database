<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<title>Biometric Detials</title>
<head>
  <link rel="stylesheet" type="text/css" href="main.css">
  <link rel="stylesheet" type="text/css" href="bio_details.css">
  <link href="https://fonts.googleapis.com/css?family=Allerta|Nunito" rel="stylesheet">
</head>
  <body>

<?php

$id=$_POST['id'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$image=$_POST['image'];

require_once('../connect.php');

$query = "SELECT height,weight,blood_group,hand_print,iris_scan from biometric_details where criminal_ID=".$id;
        
$response = mysqli_query($dbc, $query);
if (!is_bool($response)){

  $row=mysqli_fetch_row($response);

  $height=$row[0];
  $weight=$row[1];
  $blood=$row[2];
  $hand="Assets/".$row[3];
  $eye="Assets/".$row[4];
}
mysqli_close($dbc); 

?>
    <div class="navbar">
      <ul>
        <li><a href="index_log.php">Home</a></li>
        <li><a id="active" href="records_log.php">Criminal Records</a></li>
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

    <div class="bio_details">

      <ul class="tab">
        <li><a id="default" href="#" class="tablinks" onclick="openDetail(event, 'finger_print')">Finger print</a></li>
        <li><a href="#" class="tablinks" onclick="openDetail(event, 'iris_scan')">Iris scan</a></li>
        <li><a href="#" class="tablinks" onclick="openDetail(event, 'basic')">Basic</a></li>
        <p id="Biometric" style="float: right">Biometric Details</p>
      </ul>

      <div id="finger_print" class="tabcontent">

          <img id="myImg" src=<?php echo $hand;?> height="400px" width="400px">
          <div class="box" >
            <img id="box1" src="Assets/box.png">
            <img id="box2" src="Assets/box.png">
            <img id="box3" src="Assets/box.png">
            <img id="box4" src="Assets/box.png">
            <img id="box5" src="Assets/box.png">
          </div>

          <div id="myModal" class="modal">
            <span class="close">x</span>
            <img class="modal-content" id="finger" src="Assets/thumb.jpg">
            <div id="caption">Finger Print</div>  
          </div>
      </div>


      <div id="iris_scan" class="tabcontent">
        <img id="eye" src=<?php echo $eye; ?>  width="400px">
        <img id="box" src="Assets/box.png">
        <p id="info">Click on the iris to expand</p>
        <div id="myModal2" class="modal">
          <span class="close">x</span>
          <img class="modal-content" id="iris" src="Assets/iris.jpg">
          <div id="caption">Iris</div>  
        </div>
      </div>


      <div id="basic" class="tabcontent">
       <p>Height: <?php echo $height; ?>cm</p>
       <p>Wieght: <?php echo $weight; ?>kg</p>
       <p>Blood group: <?php echo $blood; ?></p>
      </div>

      <div class="details">
        <p id="cid">ID: <?php echo $id;?></p>
        <img id="image" src="<?php echo $image;?>">
        <p id="name"><?php echo $fname.' '.$lname;?></p>
      </div>
    </div>

    <script type="text/javascript" src="bio_details.js"></script>
       
  </body>
</html> 
