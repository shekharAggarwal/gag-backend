<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/urdirver/insertnewroundway.php
 *Method : POST
 *Params : phone,name,birthdate,address
 *Result : JSON
 */
if(isset($_POST['CabDriver']) && isset($_POST['BookAccount']) && isset($_POST['name']) && isset($_POST['image']) && isset($_POST['Rating']) && isset($_POST['Review']))
{

    $CabDriver = $_POST['CabDriver'];
    $BookAccount = $_POST['BookAccount'];
    $Name = $_POST['name'];
    $Image = $_POST['image'];
    $rating = $_POST['Rating'];
    $Review = $_POST['Review'];
         
         $trip = $db->insertRating($CabDriver,$BookAccount,$Name,$Image,$rating,$Review);
         if($trip)
         {
             echo json_encode("Thank you");
         }
         else
         {
             $response= "error while writing to databse try again!";
             echo json_encode($response);
         }
  
}
else
{
    $response= "Required parameter (CabDriver,BookAccount,Rating,Review) is missing!";
    echo json_encode($response); 
}
?>