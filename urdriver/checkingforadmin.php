<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/urdriver/checkuser.php
 *Method : POST
 *Params : phone
 *Result : JSON
 */
if(isset($_POST['phone']) && isset($_POST['code']))
{
    $phone = $_POST['phone'];
    $code = $_POST['code'];
    if($code==0){
    $response = $db->checkDriverForAadmin($phone);
    echo json_encode($response);
    }else if($code==1){
        $response = $db->checkUserForAdmin($phone);
    echo json_encode($response);
    }
}
else
{
    $response= "Required parameter (phone) is missing!";
    echo json_encode($response); 
}
?>