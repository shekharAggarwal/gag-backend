<?php
require_once 'db_functions.php';
$db = new DB_Functions();

    if(isset($_POST["phone"]) && isset($_POST["image"])){
        $phone = $_POST["phone"];
        $image = $_POST["image"];
        
        
       $result = $db->updateLicenseUrl($phone,$image);
                if($result){
                 echo json_encode("uploaded");
                }else{
                 echo json_encode("error while write to database");
                }
    }else{
        echo json_encode("missing phone field!");
    }

?>