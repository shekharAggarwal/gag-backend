<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/urdriver/updatepwd.php
 *Method : POST
 *Params : phone
 *Result : JSON
 */
$response = array();
if(isset($_POST['cabDriver']) && isset( $_POST['code']) && isset( $_POST['date']))
{
    $cabDriver = $_POST['cabDriver'];
    $code = $_POST['code'];
    $date = $_POST['date'];
    $count=$db->getBookingCount($cabDriver,$code,$date);
    echo json_encode($count);
}
else
{
    echo json_encode("0"); 
}
?>