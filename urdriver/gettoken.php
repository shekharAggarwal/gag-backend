<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/shopnow/gettoken.php
 *Method : POST
 *Params : UserPhone,isServerToken
 *Result : JSON
 */
 
if(isset($_POST['phone']) && isset($_POST['isServerToken']))
{
    $phone = $_POST['phone'];
    $isServerToken = $_POST['isServerToken'];
   
         
         $token = $db->getToken($phone,$isServerToken);
            echo json_encode($token);
      
  
}
else
{
    $response= "Required parameter (userPhone , isServerToken) is missing!";
    echo json_encode($response); 
}
?>