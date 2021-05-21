<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/urdirver/insertnewroundway.php
 *Method : POST
 *Params : phone,name,birthdate,address
 *Result : JSON
 */
if(isset($_POST['fullName']) && isset($_POST['phoneNumber']) && isset($_POST['email']) && isset($_POST['sourceAddress']) && isset($_POST['destinationAddress']) && isset($_POST['pickupDate']) && isset($_POST['dropDate']) && isset($_POST['pickupTime']) && isset($_POST['source']) && isset($_POST['destination']) && isset($_POST['Cabs']) && isset($_POST['BookAccount']) && isset($_POST['cabFare']) && isset($_POST['cabDriver']) && isset($_POST['cabStatus']) && isset($_POST['cabModel']) && isset($_POST['cabTnxId']) && isset($_POST['StartTrip']) && isset($_POST['DropTrip']) && isset($_POST['TripStatus'])&& isset($_POST['PickUpMeter']) && isset($_POST['DropMeter'])&& isset($_POST['TripToll']) && isset($_POST['TripCode']))
{

    $fullName = $_POST['fullName'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $sourceAddress = $_POST['sourceAddress'];
    $destinationAddress = $_POST['destinationAddress'];
    $pickupDate = $_POST['pickupDate'];
    $dropDate = $_POST['dropDate'];
    $pickupTime = $_POST['pickupTime'];
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $Cabs = $_POST['Cabs'];
    $BookAccount = $_POST['BookAccount'];
    $cabFare = $_POST['cabFare'];
    $cabDriver = $_POST['cabDriver'];
    $cabStatus = $_POST['cabStatus'];
    $cabModel = $_POST['cabModel'];
    $cabTnxId = $_POST['cabTnxId'];
    $StartTrip = $_POST['StartTrip'];
    $DropTrip = $_POST['DropTrip'];
    $TripStatus = $_POST['TripStatus'];
    $PickUpMeter = $_POST['PickUpMeter'];
    $DropMeter = $_POST['DropMeter'];
    $TripToll = $_POST['TripToll'];
    $TripCode = $_POST['TripCode'];
         
         $trip = $db->insertNewTripBooking($fullName,$phoneNumber,$email,$sourceAddress,$destinationAddress,$pickupDate,$dropDate,$pickupTime,$source,$destination,$Cabs,$BookAccount,$cabFare,$cabDriver,$cabStatus,$cabModel,$cabTnxId,$StartTrip,$DropTrip,$TripStatus,$PickUpMeter,$DropMeter,$TripToll,$TripCode);
         if($trip)
         {
             echo json_encode($trip);
         }
         else
         {
             $response= "error while writing to databse try again!";
             echo json_encode($response);
         }
  
}
else
{
    $response= "Required parameter (fullName,phoneNumber,email,sourceAddress,destinationAddress,pickupDate,dropDate,pickupTime,source,destination,Cabs,BookAccount,cabDriver,cabStatus,cabModel,canTnxId) is missing!";
    echo json_encode($response); 
}
?>