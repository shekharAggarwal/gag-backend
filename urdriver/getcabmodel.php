<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/shopnow/gettrip.php
 *Method : POST
 *Params : phone,name,birthdate,address
 *Result : JSON
 */
if(isset($_POST['phone']))
{
    $phone = $_POST['phone'];
         $driver = $db->getCabModel($phone);
         echo json_encode($driver["CabModel"]);
}else{
    echo json_encode("ERROR");
}
?>