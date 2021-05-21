<?PHP
require_once 'db_functions.php';
$db = new DB_Functions();

if(isset($_POST['phone']) && isset($_POST['code'])){
    
    $phone = $_POST['phone'];
    $code = $_POST['code'];
    
    $status = $db->updateCabDriverStatus($code,$phone);
    if($status){
        if($code==1){
          	$name = $status["Name"];
          	$email = $status["Email"];
          	$password = $status["Password"];
          	$status = $db->sendMail($email,$name,$password);
          	if($status){
          	    echo json_encode("ok");
          	}else{
          	    echo json_encode("Error while sending to driver");
          	}
          	
        }
        else if ($code==2)
        {
            $name = $status["Name"];
          	$email = $status["Email"];
          	$someArray = json_decode($_POST['arr'], true);
          	$arr = $someArray;
          	$status = $db->sendMailNot($email,$name,$arr);
          	if($status){
          	    echo json_encode("ok");
          	}else{
          	    echo json_encode("Error while sending to driver");
          	}
        }
    }
        else
        echo json_encode("Error while update to database");
    
}else{
    
    echo json_encode("Required parameter(phone,token,isServerToken) is missing");
    
}

?>