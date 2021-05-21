<?php
require_once 'db_functions.php';
$db = new DB_Functions();

$cabs = $db->getAllDriver();
echo json_encode($cabs);

?>