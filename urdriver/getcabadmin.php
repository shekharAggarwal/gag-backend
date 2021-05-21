<?php
require_once 'db_functions.php';
$db = new DB_Functions();
if(isset($_POST['CabType']) and isset($_POST['cabLocation'])and isset($_POST['cabModel']))
{
$cabs = $db->getCabAdmin($_POST['CabType'],$_POST['cabLocation'],$_POST['cabModel']);
echo json_encode($cabs);
}
?>