<?php
require_once 'db_functions.php';
$db = new DB_Functions();

if(isset($_POST['Phone']))
{
    $Phone = $_POST['Phone'];
    $cabs = $db->getCabDetails($Phone);
    echo json_encode($cabs);
}
else
{
    echo json_encode("Required parameter (Phone) is missing!"); 
}

?>