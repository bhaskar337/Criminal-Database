<?php   
session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
	 <link rel="stylesheet" type="text/css" href="records.css">
	<link href="https://fonts.googleapis.com/css?family=Allerta|Nunito" rel="stylesheet">
	<title>Criminal Records</title>
</head>
<body>
	<div class="navbar">
    	<ul>
        <li><a href="index_log.php">Home</a></li>
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
      <?php 

        if($_GET['search']==""){

            header("Location: index_log.php");
            exit();
          }        
          $search=$_GET['search'];

        require_once('../connect.php');

            $query="SELECT criminal_id,CONCAT(criminal_fname,' ',criminal_lname),criminal_image,criminal_type from criminal
             where criminal_fname like '$search%' or 
             criminal_lname like '$search%' or
              CONCAT(criminal_fname,' ',criminal_lname) like '$search%' or 
              CONCAT(criminal_lname,' ',criminal_fname) like '$search%'";
              
            $response = mysqli_query($dbc, $query);
            
            $count=0;
            $id= array();
            $name= array();
            $image= array();
            $type = array();

            if (!is_bool($response)){

              while($row=mysqli_fetch_row($response)){
                $id[]=$row[0];
                $name[]=$row[1];
                $image[]="Assets/".$row[2];
                $type[]=ucwords($row[3]);
                $count++;
              }
            }
              echo "
              <div id='namelist' class='tabcontent'>
                <table class='txt'>
                 <tr id='search_result'>
                  <th colspan=2><p>Name Searched: $search</p></th>
                  <th ><p>$count results found</p></th>

                </tr>
                <tr>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Status</th>
                </tr>";
                if (sizeof($name)==0){
                  echo "
                  <tr>
                    <td colspan=3>No data found</td>
                  </tr>";
                }
              
              for ($i=0;$i<sizeof($name);$i++){

                echo "
                <tr id='$id[$i]' onClick='getRow(this.id)'>
                  <td><img src='$image[$i]' height='150px'></td>
                  <td>$name[$i]</td>
                  <td>$type[$i]</td>
                </tr>";

              }
            echo "
              </table>
            </div>";
      
       mysqli_close($dbc);  


       ?>  

    </div>

<script>

function getRow(id)
{
    window.location="http://localhost:80/searched.php?id="+id;
}
</script>

  </body>
</html>