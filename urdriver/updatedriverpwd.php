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
if(isset($_POST['password']) && isset( $_POST['phone']))
{
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $response["error_msg"] = $db->updateDriverPassword($password,$phone);
    echo json_encode($response);
}
else
{
    $response["error_msg"]= "Required parameter (password,phone) is missing!";
    echo json_encode($response); 
}
?>