<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/shopnow/register.php
 *Method : POST
 *Params : phone,name,birthdate,address
 *Result : JSON
 */
$response = array();
if(isset($_POST['phone']))
{
    $phone = $_POST['phone'];
         $driver = $db->getDriverInfo($phone);
         if($driver)
         {
             $response["Name"] = $driver["Name"];
             $response["driverImage"] = $driver["driverImage"];
                echo json_encode($response);
         }
         else
         {
             $response["error_msg"]= "Driver does not exists";
             echo json_encode($response);
         }
  
}
else
{
    $response["error_msg"]= "Required parameter (email,password) is missing!";
    echo json_encode($response); 
}
?>