<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/shopnow/getrating.php
 *Method : POST
 *Params : phone,name,birthdate,address
 *Result : JSON
 */
if(isset($_POST['phone']))
{
    $phone = $_POST['phone'];
    $driver = $db->getRattingForUser($phone);
    echo json_encode($driver);
}else{
    echo json_encode("ERROR");
}