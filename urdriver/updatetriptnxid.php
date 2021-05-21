<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/urdriver/updatetrip.php
 *Method : POST
 *Params : phone
 *Result : JSON
 */
if(isset($_POST['id']) and isset($_POST['CabTnxId']))
{
    $id = $_POST['id'];
    $CabTnxId = $_POST['CabTnxId'];
    $get = $db->updateTxnIdTrip($id,$CabTnxId);
    if($get){
        echo "ok";
    }else{
        echo "error in update";
    }
}
?>