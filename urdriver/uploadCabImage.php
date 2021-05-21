<?php
require_once 'db_functions.php';
$db = new DB_Functions();

if(isset($_POST['image_name']) && isset($_POST['image']) && isset($_POST['driver'])){
 
 $image_name = $_POST['image_name'];
 $image = $_POST['image'];
 $driver =$_POST['driver'];
 $path = "cab_image/$driver/$image_name.jpeg";
 
 $dir_name ="cab_image/$driver/";

//Check if the directory with the name already exists
if (!is_dir($dir_name)) {
//Create our directory if it does not exist
mkdir($dir_name);
echo json_encode(array('response'=>"Failed..."));
}
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