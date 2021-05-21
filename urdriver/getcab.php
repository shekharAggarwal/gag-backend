<?php
require_once 'db_functions.php';
$db = new DB_Functions();
if(isset($_POST['CabType']) and isset($_POST['cabLocation']))
{
$cabs = $db->getCab($_POST['CabType'],$_POST['cabLocation']);
echo json_encode($cabs);
}
?>