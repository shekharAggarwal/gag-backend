<?php
require_once 'db_functions.php';
$db = new DB_Functions();

if(isset($_POST['cabModel']))
{
    $cabModel = $_POST['cabModel'];
    
    $cabs = $db->getCabByModel($cabModel);
    echo json_encode($cabs);
}
else
{
    echo json_encode("Required parameter (cabModel) is missing!"); 
}

?>