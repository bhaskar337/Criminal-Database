<?php 
require_once("../connect.php");
$arr=explode(',',$_POST['elements']);
$response=mysqli_query($dbc,"SELECT MAX(criminal_id) FROM `criminal`");
$row=mysqli_fetch_row($response);
$id=$row[0];
echo var_dump($id);
for($i=0;$i<sizeof($arr);$i++){
$var=$arr[$i];
	mysqli_query($dbc,"INSERT INTO `crime_type` (`criminal_id`, `criminal_ctype`) VALUES ('$id', '$var');");
}
?>
