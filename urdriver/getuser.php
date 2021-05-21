<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/shopnow/register.php
 *Method : POST
 *Params : phone,name,birthdate,address
 *Result : JSON
 */
$response = array();
if(isset($_POST['email']) && isset($_POST['password']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
   
         
         $user = $db->getUserInformation($email);
         if($user)
         {
             if($user["Email"]== $email && $user["Password"]==$password){
                $response["id"] = $user["Id"];
                $response["phone"] = $user["Phone"];
                $response["username"] = $user["Name"];
                $response["email"] = $user["Email"];
                $response["image"] = $user["userImage"];
                $response["password"] = $user["Password"];
                echo json_encode($response);
             }
            else{
               $response["error_msg"] = "Email id or password don't match";
               echo json_encode($response);
            }
         }
         else
         {
             $response["error_msg"]= "User does not exists";
             echo json_encode($response);
         }
  
}
else
{
    $response["error_msg"]= "Required parameter (email,password) is missing!";
    echo json_encode($response); 
}
?>