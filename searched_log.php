<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Results</title>
		<link href="searched.css" type="text/css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Allerta|Nunito" rel="stylesheet">
	</head>
	<body>
	<div class="navbar">
    <ul>
      <li><a href="http://localhost:80/index_log.php">Home</a></li>
      <li><a href="http://localhost:80/records_log.php id="active">Criminal Records</a></li>
      <li><a href="#">About</a></li>
      <li style="float:right"><a href="http://localhost:80/index.html">Logout</a></li>
      <li style="float:right"><a href="">Enter new record</a></li>
    </ul>
    <div id="id"> 
    Batch ID: 
    <?php   
    echo $_SESSION["id"];
    ?>
    </div>
  </div>
  	<?php


require_once('../connect.php');
        
$id=$_GET['id'];

/********************* TABLE CRIMINAL *********************/

$query="SELECT criminal_fname,criminal_lname, criminal_gender,criminal_dob, year(NOW())-year(criminal_dob), criminal_image,criminal_type from criminal where criminal_id=".$id;
        
$response = mysqli_query($dbc, $query);
if (!is_bool($response)){

  $row=mysqli_fetch_row($response);

  $fname=$row[0];
  $lname=$row[1]; 
  $gender=$row[2];
  $dob="Date of birth: ".$row[3];
  $age=$row[4];
  $image=$row[5];
  $type=$row[6];
}

/********************* TABLE CRIME TYPE *********************/


$query="SELECT criminal_ctype from crime_type where criminal_id=".$id;
        
$response = mysqli_query($dbc, $query);

$ctype= array();
if (!is_bool($response)){

  while($row=mysqli_fetch_row($response)){
    $ctype[]=$row[0];
  }
}

/********************* TABLE CRIMINAL ADRESS *********************/


$query="SELECT country,state,city,pin from criminal_adress where criminal_id=".$id;

$response = mysqli_query($dbc, $query);
if (!is_bool($response)){

  $row=mysqli_fetch_row($response);

  $country="Country: ".$row[0];
  $state="State: ".$row[1];
  $city="City: ".$row[2];
  $pin="Pincode: ".$row[3];
}

/********************* TABLE CONVICT/EXCONVICT/WANTED *********************/


if ($type="convict"){

  $query="SELECT conduct,sentence from convict where criminal_id=".$id;
  $response = mysqli_query($dbc, $query);
  if (!is_bool($response)){

    $row=mysqli_fetch_row($response);

    $sentence="Sentence: ".$row[1]." years";
    $conduct="Conduct :".$row[0];
  }
}

else if ($type="exconvict"){

  $query="SELECT previous_jailtime,alive from exconvict where criminal_id=".$id;
  $response = mysqli_query($dbc, $query);
  if (!is_bool($response)){

    $row=mysqli_fetch_row($response);

    $pjt="Previous jail time: ".$row[0]." years";
    $alive="Currenly ".$row[1];
  }
}

else if ($type="wanted"){

  $query="SELECT potential_penalty from wanted where criminal_id=".$id;
  $response = mysqli_query($dbc, $query);
  if (!is_bool($response)){

    $row=mysqli_fetch_row($response);

    $ppen="Potential Penalty: ".$row[0]." years";
  }
}

  mysqli_close($dbc); 

  	echo "<div class='result'>
  		<table>
  			<thead>
  				<th>$fname $lname</th>
  				<th><img src='$image' id='image'></th>
  			</thead>
  			<tbody>
  				<tr>
  					<td>ID: </td>
  					<td>$id</td>
  				</tr>
  				<tr>
  					<td>Age: </td>
  					<td>$age</td>
  				</tr>
  				<tr>
  					<td>Gender: </td>
  					<td>$gender</td>
  				</tr>
  				<tr>
  				<tr>
  					<td>
              <button class='accordion'>Crime Types</button>
              <div class='panel'>";
                for ($i=0;$i<sizeof($ctype);$i++){
          
                  echo $ctype[$i]."<br>";
                }
             echo "</div> 
            </td>
            <td>
              <button class='accordion'>More Information</button>
              <div class='panel'>";
              if ($type=='convict'){
                $type=ucwords($type);
                echo "<p>$type<br>$sentence<br>$conduct</p>";
              }
              else if ($type=='exconvict'){
                $type=ucwords($type);
                echo "<p>$type<br>$pjt<br>$alive</p>";
              }
              else if ($type=='wanted'){
                $type=ucwords($type);
                echo "<p>$type<br>$ppen</p>";
              }

              echo "</div> 
            </td> 
  				</tr>
          <tr>
          <tr >
            <td>
              <button class='accordion'>Personal Details</button>
              <div class='panel'>
                <p>$dob<br>$country<br>$state<br>$city<br>$pin</p>
              </div> 
            </td>
             <td> 
                <form action='http://localhost:80/bio_details.php' method='post'>
                  <input type='hidden' name='id' value= $id>
                  <input type='hidden' name='fname' value= $fname>
                  <input type='hidden' name='lname' value= $lname>
                  <input type='hidden' name='image' value= $image>
                  <input class='details' type='submit' name='submit' value='Biometric Details'>
                  <img id='arrow' src='Assets/arrow.png'>
                </form>
            </td>
          </tr>
          <tr>
  			</tbody>
  		</table>
  	</div>";

    ?>
<script>
var acc = document.getElementsByClassName("accordion");
var i,isActive;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
        isActive=(isActive==1)?0:1;
        if(isActive){
          window.setTimeout(myTimer,400);
        }
  }
}
function myTimer(){
  window.scrollBy(0, 1000);
}


</script>
	</body>
</html>
