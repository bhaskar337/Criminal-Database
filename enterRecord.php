<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>New record</title>
  <link rel="stylesheet" type="text/css" href="main.css">
  <link rel="stylesheet" type="text/css" href="enterRecord.css">
  <link href="https://fonts.googleapis.com/css?family=Allerta|Nunito" rel="stylesheet">
  <script src="enterRecord.js" type="text/javascript"></script>
</head>
<body>

  <div class="navbar">
    <ul>
      <li><a href="index_log.php">Home</a></li>
      <li><a href="records_log.php">Criminal Records</a></li>
      <li><a href="#">About</a></li>
      <li style="float:right"><a href="index.html">Logout</a></li>
      <li style="float:right"><a href="#" id="active">Enter New Record</a></li>
    </ul>
     <div id="id"> 
        Batch ID: 
        <?php 
         if (!isset($_SESSION["id"])){
	        header("Location: http://localhost:80/records.php");
	        exit();
      	}  
        echo $_SESSION["id"];
        ?>
      </div>
  </div>
<div class="mn">
   <div class="nm">
    <p id="c">C</p>
    <p id="rime-in">rime-In</p>
    <p id="dex">Dex</p>
    <p id="rime-in">: New Record</p>
  </div>
  <div class="newRecord" id="pg1">
    <form method='POST' enctype="multipart/form-data">
    <span>
    	<span class="ipname" id="nme">Name: </span>
       <input id="name" type="text" name="fname" placeholder="First name" required>
       <input id="name" class="surname" type="text" name="lname" placeholder="Last name" required>
    </span>
    <div id="cal">
    <span class="ipname" id="cal">Date of Birth: </span>
    <input id="date" name='date' type="text" placeholder="DD-MM-YYYY">
    </div> 	
	<div id="radio">
	<span class="ipname" id="gndr">Gender: </span>
 	 <input type="radio" name="gndr" value="Male" checked><label class="rad"> Male</label>
  	<input type="radio" name="gndr" value="Female"><label class="rad">Female</label>
      	</div>
      <div id="country">
      	<span class="ipname" id="cntry">Country: </span>
      	<input id="cname" type="text" name="country" placeholder="Country">
      	<span class="ipname" id="stt">State: </span>
      	<input id="cname" type="text" name="state" placeholder="State">
      	</div>
      	 <div id="city">
      	<span class="ipname" id="cty">City: </span>
      	<input id="cname" type="text" name="city" placeholder="City">
      	<span class="ipname" id="pcode">Pincode: </span>
      	<input id="cname" type="text" name="pincode" placeholder="Pincode">
      	</div>
      <p class="img" id="im">Image: </p>
      <label for="browse">
      <label id="click">Click to upload</label>
      <img id="avatar" src='blank.gif' style="height: 200px; width:200px;">
      </label>
      <input id="browse" type="file" name="im" onchange="previewFile()">
    </div>
  <input type="submit" id="bttn" name='submit' value='Continue' >
    </form>
      <?php
            require_once('../connect.php');
            if (isset($_POST['submit'])) {
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$gender = $_POST['gndr'];
		$dob = $_POST['date'];
                $zip=$_POST['pincode'];
                $city=$_POST['city'];
                $state=$_POST['state'];
                $country=$_POST['country'];
		$img = basename($_FILES['im']['name']);
		$uploaddir = __DIR__."/Images/";	
		$uploadfile = $uploaddir . basename($_FILES['im']['name']);					
		move_uploaded_file($_FILES['im']['tmp_name'], $uploadfile);
		$res=mysqli_query($dbc,"SELECT * FROM `criminal` ");
		if($res->num_rows==0)
		{
			$id=100;
		}
		else
		{
			$response=mysqli_query($dbc,"SELECT MAX(criminal_id) FROM `criminal`");
			$row=mysqli_fetch_row($response);
			$row[0]++;
			$id=$row[0];
		}
		mysqli_query($dbc,"INSERT INTO `criminal` (`criminal_id`, `criminal_fname`, `criminal_lname`, `criminal_gender`, `criminal_dob`, `criminal_image`) VALUES ('$id', '$fname', '$lname', '$gender', '$dob', '$img');");
            mysqli_query($dbc,"INSERT INTO `criminal_address` (`Zip`, `City`, `State`, `Country`, `criminal_id`) VALUES ('$zip', '$city', '$state', '$country', '$id');");
		 header("Location: enterRecord2.php");

	}
?>
  </div>
</div>
</body>
</html>
