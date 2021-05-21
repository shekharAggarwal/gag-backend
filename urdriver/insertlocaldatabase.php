<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/urdirver/insertlocaldatabase.php
 *Method : POST
 *Params : phone,UserDataOneWay,CabOneWay,UserDataRoundWay,CabRoundWay,NotificationDB,DriverPhone,MapStatus
 *Result : JSON
 */
/*if(isset($_POST['Phone']) && isset($_POST['UserDataOneWay']) && isset($_POST['CabOneWay']) && isset($_POST['UserDataRoundWay']) && isset($_POST['CabRoundWay']) && isset($_POST['NotificationDB']) && isset($_POST['DriverPhone']) && isset($_POST['MapStatus']))
{*/

    $Phone = isset($_POST['Phone']) ? $_POST['Phone'] : '';
    $UserDataOneWay = isset($_POST['UserDataOneWay']) ? $_POST['UserDataOneWay'] : '';
    $CabOneWay = isset($_POST['CabOneWay']) ? $_POST['CabOneWay'] : '';
    $UserDataRoundWay = isset($_POST['UserDataRoundWay']) ? $_POST['UserDataRoundWay'] : '';
    $CabRoundWay = isset($_POST['CabRoundWay']) ? $_POST['CabRoundWay'] : '';
    $NotificationDB = isset($_POST['NotificationDB']) ? $_POST['NotificationDB'] : '';
    $DriverPhone =isset($_POST['DriverPhone']) ? $_POST['DriverPhone'] : '';
    $MapStatus = isset($_POST['MapStatus']) ? $_POST['MapStatus'] : '';
         
         $check = $db->checkPhoneLocalDatabase($Phone);
         if($check=="ok"){
             $trip = $db->updateLocalDatbase($Phone,$UserDataOneWay,$CabOneWay,$UserDataRoundWay,$CabRoundWay,$NotificationDB,$DriverPhone,$MapStatus);
            if($trip)
            {
                 echo json_encode("ok");
            }
            else
            {
                echo json_encode("error while writing to database");
            }
         }
         else{
            $trip = $db->insertLocalDatbase($Phone,$UserDataOneWay,$CabOneWay,$UserDataRoundWay,$CabRoundWay,$NotificationDB,$DriverPhone,$MapStatus);
            if($trip)
            {
                 echo json_encode("ok");
            }
            else
            {
                echo json_encode("error while writing to databse");
            }
         }
  
/*}
else
{
    $response= "Required parameter (Phone,UserDataOneWay,CabOneWay,UserDataRoundWay,CabRoundWay,NotificationDB,DriverPhone,MapStatus) is missing!";
    echo json_encode($response); 
}*/
?>