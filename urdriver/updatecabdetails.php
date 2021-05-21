<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/urdriver/updatepwd.php
 *Method : POST
 *Params : phone
 *Result : JSON
 */
if(isset($_POST['cabBrand']) && isset($_POST['cabModel']) && isset($_POST['CabImage']) && isset($_POST['cabSitting']) && isset($_POST['CabType']) && isset($_POST['CabCity']) && isset($_POST['Phone']) && isset($_POST['CabNumber']))
{
    
    $CabType = $_POST['CabType'];
    $CabCity = $_POST['CabCity'];
    $CabImage = $_POST['CabImage'];
    $Phone = $_POST['Phone'];
    $cabBrand = $_POST['cabBrand'];
    $cabModel = $_POST['cabModel'];
    $cabSitting = $_POST['cabSitting'];
    $CabNumber = $_POST['CabNumber'];
    
    $response= $db->updateCabDetail($CabType,$CabImage,$CabCity,$Phone,$cabBrand,$cabModel,$cabSitting,$CabNumber);
   if($response){
            echo json_encode("OK");
    }else
            echo json_encode("Error while update on database");
    
}
else
{
    $response= "Required parameter (cabprice,cabImage,cabdec,Phone) is missing!";
    echo json_encode($response); 
}
?>