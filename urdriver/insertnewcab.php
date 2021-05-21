<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/urdirver/insertnewcab.php
 *Method : POST
 *Params : phone,name,birthdate,address
 *Result : JSON
 */
if(isset($_POST['cabBrand']) && isset($_POST['cabModel']) && isset($_POST['cabImage']) && isset($_POST['cabSitting']) && isset($_POST['cabType']) && isset($_POST['cabCity']) && isset($_POST['cabDriver']) && isset($_POST['CabNumber']))
{

    $cabBrand = $_POST['cabBrand'];
    $cabModel = $_POST['cabModel'];
    $cabImage = $_POST['cabImage'];
    $cabSitting = $_POST['cabSitting'];
    $cabType = $_POST['cabType'];
    $cabCity = $_POST['cabCity'];
    $cabDriver = $_POST['cabDriver'];
    $CabNumber = $_POST['CabNumber'];
         
         $cab = $db->insertNewCab($cabBrand,$cabModel,$CabNumber,$cabImage,$cabSitting,$cabType,$cabCity,$cabDriver);
         if($cab=="ok")
         {
             echo json_encode($cab);
         }
         else
         {
             echo json_encode($cab);
         }
}
else
{
    $response= "Required parameter (cabBrand,cabModel,cabImage,cabSitting,cabPrice,cabDec,cabDrive) is missing!";
    echo json_encode($response); 
}
?>