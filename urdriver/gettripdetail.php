<?php
require_once 'db_functions.php';
$db = new DB_Functions();

if( isset($_POST['BookAccount']) 
and isset($_POST['CabDriver']))
{
    $BookAccount = $_POST['BookAccount'];
    $CabDriver = $_POST['CabDriver'];
    $response= $db->getTripDetailForUser($BookAccount,$CabDriver);
    echo json_encode($response);
}
else
{
    $response= "Error, Try Again!";
    echo json_encode($response); 
}
?>