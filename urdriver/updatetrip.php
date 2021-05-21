<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/urdriver/updatetrip.php
 *Method : POST
 *Params : phone
 *Result : JSON
 */
if(isset($_POST['code']))
{
    $code = $_POST['code'];
    
    if($code==0){
        if(isset($_POST['id']) && isset($_POST['DropMeter'])){
            $id = $_POST['id'];
            $DropMeter = $_POST['DropMeter'];
            $response= $db->updateDropMeterTripBooking($id,$DropMeter);
            if($response)
                echo json_encode("OK");
            else
                echo json_encode("Error While Updating to DataBase");
        }
        else{
             $response= "Required parameter (id,DropMeter) is missing!";
             echo json_encode($response); 
        }
    } else if($code==1){
        if(isset($_POST['id']) && isset($_POST['DropTrip'])){
            $id = $_POST['id'];
            $DropTrip = $_POST['DropTrip'];
            $response= $db->updateDropTripBooking($id,$DropTrip);
            if($response)
                echo json_encode("OK");
            else
                echo json_encode("Error While Updating to DataBase");
        }
        else{
             $response= "Required parameter (id,DropTrip) is missing!";
             echo json_encode($response); 
        }
    } else if($code==2){
        if(isset($_POST['id']) && isset($_POST['TripStatus'])){
            $id = $_POST['id'];
            $TripStatus = $_POST['TripStatus'];
            $response= $db->updateTripStatusBooking($id,$TripStatus);
            if($response)
                echo json_encode("OK");
            else
                echo json_encode("Error While Updating to DataBase");
        }
        else{
             $response= "Required parameter (id,TripStatus) is missing!";
             echo json_encode($response); 
        }
    } else if($code==3){
        if(isset($_POST['id']) && isset($_POST['TripToll'])){
            $id = $_POST['id'];
            $TripToll = $_POST['TripToll'];
            $response= $db->updateTripTollBooking($id,$TripToll);
            if($response)
                echo json_encode("OK");
            else
                echo json_encode("Error While Updating to DataBase");
        }
        else{
             $response= "Required parameter (id,TripToll) is missing!";
             echo json_encode($response); 
        }
    } else if($code==4){
        if(isset($_POST['id']) && isset($_POST['TripToll']) && isset($_POST['TripStatus']) && isset($_POST['DropTrip']) && isset($_POST['NightStay']) && isset($_POST['DropMeter'])){
            $id = $_POST['id'];
            $TripToll = $_POST['TripToll'];
            $TripStatus = $_POST['TripStatus'];
            $DropTrip = $_POST['DropTrip'];
            $DropMeter = $_POST['DropMeter'];
            $NightStay = $_POST['NightStay'];
            $response= $db->updateTripDataBooking($id,$TripToll,$TripStatus,$DropTrip,$DropMeter,$NightStay);
            if($response)
                echo json_encode("OK");
            else
                echo json_encode("Error While Updating to DataBase");
        }
        else{
             $response= "Required parameter (id,TripToll) is missing!";
             echo json_encode($response); 
        }
    } else if($code==5){
        if(isset($_POST['id']) && isset($_POST['CabFare']) && isset($_POST['CabTnxId'])){
            $id = $_POST['id'];
            $CabFare = $_POST['CabFare'];
            $CabTnxId= $_POST['CabTnxId'];
            $response= $db->updateFareTripBooking($id,$CabFare,$CabTnxId);
            if($response)
                echo json_encode("OK");
            else
                echo json_encode("Error While Updating to DataBase");
        }
        else{
             $response= "Required parameter (id,CabFare) is missing!";
             echo json_encode($response); 
        }
    }
}
else
{
    $response= "Required parameter (code) is missing!";
    echo json_encode($response); 
}
?>