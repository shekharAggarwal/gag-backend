<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/urdriver/updatepwd.php
 *Method : POST
 *Params : phone
 *Result : JSON
 */
$response = array();
if(isset($_POST['driverStatus']) && isset( $_POST['phone']))
{
    $phone = $_POST['phone'];
    $driverStatus = $_POST['driverStatus'];
    $response = $db->updateDriverStatus($driverStatus,$phone);
    echo json_encode($response);
}
else
{
    $response= "Required parameter (DriverStatus,phone) is missing!";
    echo json_encode($response); 
}
?>