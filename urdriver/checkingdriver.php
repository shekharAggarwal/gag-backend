<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/urdriver/checkuser.php
 *Method : POST
 *Params : phone
 *Result : JSON
 */
$response = array();
if(isset($_POST['phone']))
{
    $phone = $_POST['phone'];
    $response["error_msg"] = $db->CheckDriver($phone);
    echo json_encode($response);
}
else
{
    $response["error_msg"]= "Required parameter (phone) is missing!";
    echo json_encode($response); 
}
?>