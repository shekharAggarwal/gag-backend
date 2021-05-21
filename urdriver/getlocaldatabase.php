<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/shopnow/getlocaldatabase.php
 *Method : POST
 *Params : phone,name,birthdate,address
 *Result : JSON
 */
if(isset($_POST['phone']))
{
    $phone = $_POST['phone'];
    $local = $db->getLocalDatbase($phone);
    echo json_encode($local);
}else{
    echo json_encode("ERROR");
}