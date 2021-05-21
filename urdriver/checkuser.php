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
if( isset($_POST['email']) && isset($_POST['phone']) )
{
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $response["error_msg"] = $db->checkExistsUser($phone,$email);
    echo json_encode($response);
}
else
{
    $response["error_msg"]= "Required parameter (phone,email) is missing!";
    echo json_encode($response); 
}
?>