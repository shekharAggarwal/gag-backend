<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/urdriver/updatetrip.php
 *Method : POST
 *Params : phone
 *Result : JSON
 */
if(isset($_POST['code']) )
{
    $code = $_POST['code'];
    
    if($code==0){
        if(isset($_POST['BookAccount'])&& isset($_POST['date'])){
            $BookAccount = $_POST['BookAccount'];
            $date = $_POST['date'];
            $response= $db->getTripBookingUserbyDate($BookAccount,$date);
            echo json_encode($response);
        }
        else{
             $response= "Required parameter (BookAccount,date) is missing!";
             echo json_encode($response); 
        }
    } else if($code==1){
        if(isset($_POST['CabDriver'])&& isset($_POST['date'])){
            $CabDriver = $_POST['CabDriver'];
            $date = $_POST['date'];
            $response= $db->getTripBookingDriverbyDate($CabDriver,$date);
            echo json_encode($response);
        }
        else{
             $response= "Required parameter (BookAccount,date) is missing!";
             echo json_encode($response); 
        }
    } else if($code==2){
        if(isset($_POST['BookAccount'])){
            $BookAccount = $_POST['BookAccount'];
            $response= $db->getTripBookingUser($BookAccount);
            echo json_encode($response);
        }
        else{
             $response= "Required parameter (BookAccount) is missing!";
             echo json_encode($response); 
        }
    }else if($code==3){
        if(isset($_POST['CabDriver'])){
            $CabDriver = $_POST['CabDriver'];
            $response= $db->getTripBookingDriver($CabDriver);
            echo json_encode($response);
        }
        else{
             $response= "Required parameter (BookAccount) is missing!";
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