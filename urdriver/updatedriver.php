<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/urdriver/updatepwd.php
 *Method : POST
 *Params : phone
 *Result : JSON
 */
if(isset($_POST['id']) && isset( $_POST['Name']) && isset($_POST['image']) && isset($_POST['Phone']) && isset( $_POST['oldPhone']) && isset( $_POST['Email']))
{
    $id = $_POST['id'];
    $Name = $_POST['Name'];
    $Phone = $_POST['Phone'];
    $image = $_POST['image'];
    $oldPhone = $_POST['oldPhone'];
    $Email = $_POST['Email'];
    $response= $db->updateDriver($id,$oldPhone,$Name,$Phone,$image,$Email);
   if($response)
    {
        if($Phone==$oldPhone){
            echo json_encode("OK");
        }else{
        $response= $db->updatePhoneOneWayBooking($oldPhone,$Phone,1);
        if($response){
           $response= $db->updatePhoneRoundWayBooking($oldPhone,$Phone,1);
           if($response){
           $response= $db->updatePhoneToken($oldPhone,$Phone,1);
           if($response){
           $response= $db->updatePhoneTripBooking($oldPhone,$Phone,1);
           if($response){
               $response= $db->updateCabDetails($Phone,$oldPhone);
               if($response){
             $response= $db->updatePhoneRating($oldPhone,$Phone,1);
               if($response){
            echo json_encode("OK");
         }
         else
            echo json_encode("Error while update on database");
         }
         else
            echo json_encode("Error while update on database");
         } else
            echo json_encode("Error while update on database");
         } else
            echo json_encode("Error while update on database");
         } else
            echo json_encode("Error while update on database");
        } else
            echo json_encode("Error while update on database");
    }
    }
    else
    echo json_encode("Error while update on database");
    
}
else
{
    $response= "Required parameter (id,Name,oldPhone,Phone,Email) is missing!";
    echo json_encode($response); 
}
?>