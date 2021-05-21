<?php
require_once 'db_functions.php';
$db = new DB_Functions();

if(isset($_POST['code']))
{
    $code = $_POST['code'];
    if($code==0 && isset($_POST['BookingAccount'])){
        $BookingAccount = $_POST['BookingAccount'];
        $response= $db->getCancelledCabForUser($BookingAccount);
        echo json_encode($response);
    }
    else if($code == 1 and isset($_POST['CabDriver'])){
        $CabDriver =$_POST['CabDriver'];
        $response= $db->getCancelledCabForDriver($CabDriver);
        echo json_encode($response);
    }
    else if($code == 2){
        $response= $db->getCancelledCabForAdmin();
        echo json_encode($response);
    }
    
}
else
{
    $response= "Error, Try Again!";
    echo json_encode($response); 
}
?>