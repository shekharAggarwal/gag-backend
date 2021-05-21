<?PHP
require_once 'db_functions.php';
$db = new DB_Functions();

if(isset($_POST['phone']) && isset($_POST['token']) && isset($_POST['isServerToken'])){
    
    $phone = $_POST['phone'];
    $token = $_POST['token'];
    $isServerToken = $_POST['isServerToken'];
    
    $user = $db->checkToken($phone);
    if($user){
        $user = $db->updateToken($phone,$token,$isServerToken);
        if($user)
             echo json_encode("Token Update success");
        else
            echo json_encode("Token Update failed");
    }
    else
    {
        $user = $db->insertToken($phone,$token,$isServerToken);
        if($user)
             echo json_encode("Token Insert success");
        else
            echo json_encode("Token Insert failed");
    }
    
    
}else{
    
    echo json_encode("Required parameter(phone,token,isServerToken) is missing");
    
}

?>