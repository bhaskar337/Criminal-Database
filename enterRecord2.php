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
  <script src="jquery-3.1.1.js" type="text/javascript"></script>
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
  <div class="newRecord2" id="pg2">
    	<p class="ipname">Crime Types: </p>
    <table>
    <tr>
    	<td>Robbery</td>
    	<td>Breaking and Entering</td>
    	<td>Sexual Assault</td>
    </tr>
    <tr>
    	<td>Murderer</td>
    	<td>Serial Killer</td>
    	<td>Rapist</td>
    </tr>
    <tr>
    	<td>Chain Snatcher</td>
    	<td>Kidnapper</td>
    	<td>Fraud</td>
    </tr>
    </table>
    <form method='POST' enctype="multipart/form-data" id='myForm'>
    <br/>
     <p class="img" id="im2">Iris: </p>
      <label for="browse1">
      <label id="click2">Click to upload</label>
      <img id="avatar" src='blank.gif' style="height: 200px; width:200px;">
      </label>
      <input id="browse1" type="file" name="im" onchange="previewFile()">
      <br/>
	<span class="ipname" id="bgrp">Blood Group: </span>
 	 <input type="radio" name="bgrp" value="O+" checked><label class="rad">O+</label>
  	<input type="radio" name="bgrp" value="A+"><label class="rad">A+</label>
  		 <input type="radio" name="bgrp" value="B+"><label class="rad">B+</label>
  	<input type="radio" name="bgrp" value="AB+"><label class="rad">AB+</label>
  		 <input type="radio" name="bgrp" value="O-"><label class="rad">O-</label>
  	<input type="radio" name="bgrp" value="A-"><label class="rad">A-</label>
  		 <input type="radio" name="bgrp" value="B-"><label class="rad">B-</label>
  	<input type="radio" name="bgrp" value="AB-"><label class="rad">AB-</label>
  	<br/>
  	<br/>
  	      	<span class="ipname" id="height">Height: </span>
      	<input id="ht" type="text" name="height" placeholder="Height">
      		<span class="ipname" id="weight">Weight: </span>
      	<input id="wt" type="text" name="weight" placeholder="Weight">
      	<br/><br/>
	<span class="ipname" id="status">Current Status: </span>
 	 <input type="radio" name="status" value="Convict"><label class="rad"> Convict </label>
  	<input type="radio" name="status" value="Ex-Convict"><label class="rad"> Ex-Convict </label>
  	  <input type="radio" name="status" value="Wanted"><label class="rad"> Wanted </label>
      	</div>
      	<br/>
      	<br/>
      	<div id='convict'>
      			<span class="ipname" id="cndct">Conduct: </span>
      	<input id="conduct" type="text" name="conduct" placeholder="Conduct">
      	      			<span class="ipname" id="cndct">Sentence: </span>
      		<input type="text" id="sentence" name="sentence" placeholder="Sentence">
      		<br/><br/>
      	</div>
      	      	<div id='wanted'>
      			<span class="ipname" id="bnty">Bounty: </span>
      	<input id="bounty" type="text" name="bounty" placeholder="Bounty">

      		<br/><br/>
      	</div>
      	      	<div id='exconvict'>
      	      	   <span class="ipname" id="Alive">Alive: </span>
        <input class="rade" type="radio" name="alive" value="Yes" checked><label class="rad"> Yes </label>
  	<input class="rade" type="radio" name="alive" value="No"><label class="rad"> No </label>
      			<span class="ipname" id="prvs">Previous Jailtime: </span>
      	<input id="conduct" type="text" name="previous" placeholder="Previous Jailtime">

      		<br/><br/>
      	</div>
      	</div>
  <input type="submit" id="bttn" name='submit' value='Enter Record' >
    </form>
  </div>
</div>
<?php
	 require_once('../connect.php');
            if (isset($_POST['submit'])) {
            	$img = basename($_FILES['im']['name']);
            	$bgrp=$_POST['bgrp'];
            	$response=mysqli_query($dbc,"SELECT MAX(criminal_id) FROM `criminal`");
		$row=mysqli_fetch_row($response);
		$img = basename($_FILES['im']['name']);
		$id=$row[0];
		$ht=$_POST['height'];
		$wt=$_POST['weight'];
		$status=@$_POST['status'];
		$temp="hand.png";
		$uploaddir = __DIR__."/Images/";	
		$uploadfile = $uploaddir . basename($_FILES['im']['name']);
		move_uploaded_file($_FILES['im']['tmp_name'], $uploadfile);
		mysqli_query($dbc,"INSERT INTO `biometric_details` (`criminal_id`, `height`, `weight`, `blood_group`, `hand_print`, `iris_scan`) VALUES ($id , $ht , $wt , '$bgrp' , '$temp', '$img');");
		mysqli_query($dbc,"UPDATE `criminal` SET `criminal_type`='$status' WHERE `criminal_id`=$id");
		if($status=="Convict")
		{
			$conduct=$_POST['conduct'];
			$sentence=$_POST['sentence'];
			mysqli_query($dbc,"INSERT INTO `convict` (`criminal_id`, `conduct`, `sentence`) VALUES ($id, '$conduct', $sentence);");
		}
		else if($status="Ex-Convict")
		{
			$prev=$_POST['previous'];
			$alive=$_POST['alive'];
			mysqli_query($dbc,"INSERT INTO `exconvict` (`criminal_id`, `previous_jailtime`, `alive`) VALUES ($id, $prev, '$alive');");
		}
		else if($status="Wanted"){
			$bounty=$_POST['bounty'];
			mysqli_query($dbc,"INSERT INTO `wanted` (`criminal_id`, `potential_penalty`) VALUES ($id, $bounty);");
		}
		}
		
?>
       	 <script>
$(document).ready(function(){
	$('#myForm input').on('change', function() {
   if($('input[name=status]:checked', '#myForm').val()=="Convict")
   {
   	$('#convict').fadeIn(1000);
   	$('#exconvict').fadeOut(1);
   	$('#wanted').fadeOut(1);
   } else if($('input[name=status]:checked', '#myForm').val()=="Ex-Convict"){
      	$('#exconvict').fadeIn(1000);
      	$('#convict').fadeOut(1);
      	$('#wanted').fadeOut(1);
   }
   else if($('input[name=status]:checked', '#myForm').val()=="Wanted")
   {
   	$('#exconvict').fadeOut(1);
      	$('#convict').fadeOut(1);
      	$('#wanted').fadeIn(1000);
   }
});
	var y=[];
	$('td').click(function(){
		$(this).toggleClass('focus');
	if($(this).hasClass('focus')){
		y.push($(this).html());
	}
	else
	{
		y.splice( $.inArray($(this).html(),y) ,1 );
	}
	});
	$('#bttn').click(function(){
		var elements = y.join(',');
		$.post("entr.php",{elements:elements},
		  function(data){
		  });
	});
});
	</script>
</body>
</html>
