<?php
require_once 'db_functions.php';
$db = new DB_Functions();

if( isset($_POST['BookingAccount']) 
and isset($_POST['cabModel']))
{
    $BookingAccount = $_POST['BookingAccount'];
    $cabModel = $_POST['cabModel'];
    $response= $db->CancelCab($cabModel,$BookingAccount);
    echo json_encode($response);
    
}
else
{
    $response= "Error, Try Again!";
    echo json_encode($response); 
}
?>