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
if(isset($_POST['userPhone']) && isset($_POST['driverPhone']) && isset($_POST['status']) && isset($_POST['code']))
{
    $userphone = $_POST['userPhone'];
    $driverphone = $_POST['driverPhone'];
    $status = $_POST['status'];
    $code = $_POST['code'];
    
         $driver = $db->getRequestInfo($userphone,$driverphone,$status,$code);
         if($driver){
             if($code==0){
              $response["Id"] = $driver["Id"];
                $response["fullName"] = $driver["fullName"];
                $response["phoneNumber"] = $driver["phoneNumber"];
                $response["email"] = $driver["email"];
                $response["sourceAddress"] = $driver["sourceAddress"];
                $response["destinationAddress"] = $driver["destinationAddress"];
                $response["pickupDate"] = $driver["pickupDate"];
                $response["pickupTime"] = $driver["pickupTime"];
                $response["source"] = $driver["source"];
                $response["destination"] = $driver["destination"];
                $response["Cabs"] = $driver["Cabs"];
                $response["BookAccount"] = $driver["BookAccount"];
                $response["CabFare"] = $driver["CabFare"];
                $response["CabDriver"] = $driver["CabDriver"];
                $response["CabStatus"] = $driver["CabStatus"];
                $response["CabModel"] = $driver["CabModel"];
                echo json_encode($response);
             }else if($code==1){
                 $response["Id"] = $driver["Id"];
                $response["fullName"] = $driver["fullName"];
                $response["phoneNumber"] = $driver["phoneNumber"];
                $response["email"] = $driver["email"];
                $response["sourceAddress"] = $driver["sourceAddress"];
                $response["destinationAddress"] = $driver["destinationAddress"];
                $response["pickupDate"] = $driver["pickupDate"];
                $response["dropDate"] = $driver["dropDate"];
                $response["pickupTime"] = $driver["pickupTime"];
                $response["source"] = $driver["source"];
                $response["destination"] = $driver["destination"];
                $response["Cabs"] = $driver["Cabs"];
                $response["BookAccount"] = $driver["BookAccount"];
                $response["CabFare"] = $driver["CabFare"];
                $response["CabDriver"] = $driver["CabDriver"];
                $response["CabStatus"] = $driver["CabStatus"];
                $response["CabModel"] = $driver["CabModel"];
                echo json_encode($response);
             }
         }
}
?>