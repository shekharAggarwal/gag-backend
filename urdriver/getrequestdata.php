<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/shopnow/register.php
 *Method : POST
 *Params : phone,name,birthdate,address
 *Result : JSON
 */
if( isset($_POST['driverPhone']) && isset($_POST['date']) && isset($_POST['status']) && isset($_POST['code']))
{
    $driverphone = $_POST['driverPhone'];
    $status = $_POST['status'];
    $date = $_POST['date'];
    $code = $_POST['code'];
    
         $driver = $db->getRequestData($driverphone,$date,$status,$code);
         if($driver){
                echo json_encode($driver);
         }
}
?>