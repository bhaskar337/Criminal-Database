
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
      	<li><a href="http://localhost:80/index.html">Home</a></li>
        <li><a href="" id="active">Criminal Records</a></li>
        <li><a href="#">About</a></li>
        <li style="float:right"><a href="http://localhost:80/login.php">Login</a></li>
        <li style="float:right"><a href="http://localhost:80/register.php">Register</a></li>
    	</ul>
  </div>
    <div class="records">
      <ul class="tab">
        <li style="float:left"><a id="default" href="#" class="tablinks" onclick="openCriminal(event,'A')">A</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'B')">B</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'C')">C</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'D')">D</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'E')">E</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'F')">F</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'G')">G</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'H')">H</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'I')">I</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'J')">J</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'K')">K</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'L')">L</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'M')">M</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'N')">N</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'O')">O</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'P')">P</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'Q')">Q</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'R')">R</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'S')">S</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'T')">T</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'U')">U</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'V')">V</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'W')">W</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'X')">X</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'Y')">Y</a></li>
        <li style="float:left"><a href="#" class="tablinks" onclick="openCriminal(event,'Z')">Z</a></li>
      </ul>

      <?php 

        require_once('../connect.php');

        for ($i='A';$i<='Z';$i++){

           $query="SELECT criminal_id,CONCAT(criminal_fname,' ',criminal_lname),criminal_image,criminal_type from criminal where criminal_fname like '$i%'";
            $response = mysqli_query($dbc, $query);
            
            $id= array();
            $name= array();
            $image= array();
            $type = array();

            if (!is_bool($response)){

              while($row=mysqli_fetch_row($response)){
                $id[]=$row[0];
                $name[]=$row[1];
                $image[]="/Images/".$row[2];
                $type[]=ucwords($row[3]);
              }
            }
  
              echo "
              <div id='$i' class='tabcontent'>
                <table class='txt'>
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
              
              for ($j=0;$j<sizeof($name);$j++){

                echo "
                <tr id='$id[$j]' onClick='getRow(this.id)'>
                  <td><img src='$image[$j]' height='150px'></td>
                  <td>$name[$j]</td>
                  <td>$type[$j]</td>
                </tr>";

              }
            echo "
              </table>
            </div>";
          }
      
       mysqli_close($dbc);  


       ?>  

    </div>

<script>

function getRow(id)
{
    window.location="http://localhost:80/searched.php?id="+id;
}
window.onload = function () {
    document.getElementById("default").focus();
    document.getElementById("A").style.display = "block";
    evt.currentTarget.className += " active";
};


function openCriminal(evt, detail) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(detail).style.display = "block";
    evt.currentTarget.className += " active";
}


</script>

  </body>
</html>
