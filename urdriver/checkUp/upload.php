<?php
 
include 'config.php' ;
 
$con = mysqli_connect($Name,$User,$Pass,$DB);
 
$image_name = $_POST['image_name'];
$image = $_POST['image'];
 
$path = "Uploads/$image_name.jpg";
 
$sql = "insert into imagetable(img_name,img_path) values('$image_name','$path');";
 
if(mysqli_query($con,$sql))
{
file_put_contents($path,base64_decode($image));
echo json_encode(array('response'=>"Successfully Uploaded..."));
}
else
{
echo json_encode(array('response'=>"Failed..."));
}
mysqli_close($con);
 
?>