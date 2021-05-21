<?php
require_once 'db_functions.php';
$db = new DB_Functions();

if(isset($_POST['code']))
{
    $phone = $_POST['phone'];
    $code = $_POST['code'];
    if($code==0){
    $data = $db->getDriverInfoForAdmin($phone);
    if($data)
        echo json_encode($data);
    else
        echo json_encode("error");
    }else if($code==1){
        $data = $db->getDriverCheckStatus($phone);
        if($data)
            echo json_encode($data["result"]);
        else
            echo json_encode("error");
    }else if($code==2){
        $data = $db->getUsersForAdmin($phone);
        if($data)
            echo json_encode($data);
        else
            echo json_encode("error");
    }else if($code==3){
        $data = $db->getUsersInfoForAdminStatus($phone);
        if($data)
            echo json_encode($data);
        else
            echo json_encode("error");
    }
    else if($code==4){
        $data = $db->getDriverTripDetail($phone);
        if($data)
            echo json_encode($data);
        else
            echo json_encode("error");
    }
}
else
{
    echo json_encode("Required parameter (code) is missing!"); 
}

?>