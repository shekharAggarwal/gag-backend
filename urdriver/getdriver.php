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
if(isset($_POST['email']) && isset($_POST['password']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
   
         
         $driver = $db->getDriverInformation($email);
         if($driver)
         {
             if($driver["Email"]== $email && $driver["Password"]==$password){
                $response["id"] = $driver["Id"];
                $response["phone"] = $driver["Phone"];
                $response["name"] = $driver["Name"];
                $response["email"] = $driver["Email"];
                $response["password"] = $driver["Password"];
                $response["image"] = $driver["driverImage"];
                $response["aadharNumber"] = $driver["AadharNumber"];
                $response["aadharImage"] = $driver["AadharImage"];
                $response["licenseImage"] = $driver["LicenseImage"];
                $response["driverStatus"] = $driver["DriverStatus"];
                echo json_encode($response);
             }
            else{
               $response["error_msg"] = "Email id or password don't match";
               echo json_encode($response);
            }
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