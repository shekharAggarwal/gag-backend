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
if(isset($_POST['phoneUser']) && isset($_POST['model']) && isset($_POST['phoneDriver']) && isset($_POST['id']) && isset($_POST['status']) && isset($_POST['code']))
{
    $id = $_POST['id'];
    $status = $_POST['status'];
    $phoneUser = $_POST['phoneUser'];
    $model = $_POST['model'];
    $code = $_POST['code'];
    $phoneDriver = $_POST['phoneDriver'];
    
         $user = $db->updateRequest($id,$status,$phoneUser,$model,$code,$phoneDriver);
         if($user)
         echo json_encode("ok");
         else
         echo json_encode("error while updating database!");
}
?>