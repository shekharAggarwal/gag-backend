<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/shopnow/gettrip.php
 *Method : POST
 *Params : phone,name,birthdate,address
 *Result : JSON
 */
if(isset($_POST['id']))
{
    $id = $_POST['id'];
         $driver = $db->getTripBooking($id);
         echo json_encode($driver);
}else{
    echo json_encode("ERROR");
}
?>