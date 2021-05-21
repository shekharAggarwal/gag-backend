<?php
require_once 'db_functions.php';
$db = new DB_Functions();

if( isset($_POST['CabDriver']) 
and isset($_POST['Id']) and isset($_POST['code']))
{
    $CabDriver = $_POST['CabDriver'];
    $Id = $_POST['Id'];
    $code = $_POST['code'];
    $response= $db->cancelledCabByDriver($Id,$CabDriver,$code);
    echo json_encode($response);
    
}
else
{
    $response= "Error, Try Again!";
    echo json_encode($response); 
}
?>