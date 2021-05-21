<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/urdriver/updatepwd.php
 *Method : POST
 *Params : phone
 *Result : JSON
 */
if(isset($_POST['Phone']))
{
    $Phone = $_POST['Phone'];;
    $response= $db->deleteDriver($Phone);
   if($response)
    {
        echo json_encode("ok");
    }
    else
    echo json_encode("Error while update on database");
    
}
else
{
    $response= "Required parameter (Phone) is missing!";
    echo json_encode($response); 
}
?>