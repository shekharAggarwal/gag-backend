<?php
require_once 'db_functions.php';
$db = new DB_Functions();

if(isset($_POST['image_name']) && isset($_POST['image'])){
 
 $image_name = $_POST['image_name'];
 $image = $_POST['image'];
 $path = "DriverImage/$image_name.jpeg";
 
 $resp = $db->uploadDriverImage($path,$image);
if($resp)
{
echo json_encode(array('response'=>"Successfully Uploaded..."));
}
else
{
echo json_encode(array('response'=>"Failed..."));
}
}
?>