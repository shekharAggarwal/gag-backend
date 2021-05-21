<?php
require_once 'db_functions.php';
$db = new DB_Functions();
/*
 *EndPoint : http://<domain>/urdriver/register.php
 *Method : POST
 *Params : phone,name,birthdate,address
 *Result : JSON
 */
$response = array();
if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password']))
{
    $username = $_POST['username'];
    $email =  $_POST['email'];
    $phone =  $_POST['phone'];
    $password =  $_POST['password'];
    $image="http";
    $check =$db->checkExistsUser($phone,$email);
    if($check=="email exists")
    {
        $response["error_msg"]= "User Already existed With ".$email;
        echo json_encode($response);
        
    }else if($check=="phone number exists"){
          $response["error_msg"]= "User Already existed With ".$phone;
        echo json_encode($response); 
    }else
    {
         //create new User
         $user = $db->registerNewUser($username,$email,$phone,$password,$image);
         if($user)
         {
                 $response["id"] = $user["Id"];
                $response["phone"] = $user["Phone"];
                $response["username"] = $user["Name"];
                $response["email"] = $user["Email"];
                 $response["image"] = $user["userImage"];
                $response["password"] = $user["Password"];
            echo json_encode($response);
         }
         else
         {
             $response["error_msg"]= "Unknow Error Occurred in registration ";
             echo json_encode($response);
         }
    }
}
else
{
    $response["error_msg"]= "Required parameter (username,email,phone,password) is missing!";
    echo json_encode($response); 
}
?>