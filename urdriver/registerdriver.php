<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/urdriver/register.php
 *Method : POST
 *Params : phone,name,birthdate,address
 *Result : JSON
 */
$response = array();
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['driverImage']) && isset($_POST['aadharNumber']) && isset($_POST['aadharImage']) && isset($_POST['licenseImage'])
&& isset($_POST['driverStatus']))
{
    $name = $_POST['name'];
    $email =  $_POST['email'];
    $phone =  $_POST['phone'];
    $password =  $_POST['password'];
    $driverImage =  $_POST['driverImage'];
    $aadharNumber =  $_POST['aadharNumber'];
    $aadharImage =  $_POST['aadharImage'];
    $licenseImage =  $_POST['licenseImage'];
    $driverStatus =  $_POST['driverStatus'];
    
    $check =$db->checkExistsDriver($phone,$email);
    if($check=="email exists")
    {
        $response["error_msg"]= "Driver Already existed With ".$email;
        echo json_encode($response);
        
    }else if($check=="phone number exists"){
          $response["error_msg"]= "Driver Already existed With ".$phone;
        echo json_encode($response); 
    }else
    {
         //create new Driver
         $driver = $db->registerNewDriver($name,$email,$phone,$password,$driverImage,$aadharNumber,$aadharImage,$licenseImage,$driverStatus);
         if($driver)
         {
             if($driverStatus==1){
             $check = $db->sendMail($email,$name,$password);
             if($check){
                  $response["name"] = $driver["Name"];
             $response["email"] = $driver["Email"];
             $response["phone"] = $driver["Phone"];
             $response["password"] = $driver["Password"];
             $response["image"] = $driver["driverImage"];
             $response["aadharNumber"] = $driver["AadharNumber"];
             $response["aadharImage"] = $driver["AadharImage"];
             $response["licenseImage"] = $driver["LicenseImage"];
             $response["driverStatus"] = $driver["DriverStatus"];
            echo json_encode($response);
             }
             else{
            $response["error_msg"]= "Email Error Occurred in registration ";
            echo json_encode($response);
             }
         }else{
             $response["name"] = $driver["Name"];
             $response["email"] = $driver["Email"];
             $response["phone"] = $driver["Phone"];
             $response["password"] = $driver["Password"];
             $response["image"] = $driver["driverImage"];
             $response["aadharNumber"] = $driver["AadharNumber"];
             $response["aadharImage"] = $driver["AadharImage"];
             $response["licenseImage"] = $driver["LicenseImage"];
             $response["driverStatus"] = $driver["DriverStatus"];
            echo json_encode($response);
         }
         }
         else
         {
             $response["error_msg"]= "Unknow Error Occurred in registration ";
             echo json_encode($response);
         }
    }
}
else
{
    $response["error_msg"]= "Required parameter (username,email,phone,password,aadharNumber,aadharImage,licenseImage,driverStatus) is missing!";
    echo json_encode($response); 
}
?>