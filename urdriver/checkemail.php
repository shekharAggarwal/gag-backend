<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/urdriver/checkuser.php
 *Method : POST
 *Params : phone
 *Result : JSON
 */
if( isset($_POST['email']))
{
    $email = $_POST['email'];
    $response= $db->CheckUserEmail($email);
    echo json_encode($response);
}
else
{
    $response= "Required parameter (phone,email) is missing!";
    echo json_encode($response); 
}
?>