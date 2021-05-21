<?PHP

/*
 *Databases Functions
 */

class DB_Functions{
      
      private $conn;

      function __construct(){
        require_once 'db_connect.php';
        $db = new DB_Connect();
        $this->conn = $db->connect();

    }

      function __destruct(){
        //TODO : Imp
    }

      //*********************for checking function***********************//
      
      /*
     * check user exist
     * return true/false
     */
      function CheckUser($phone) {
         $stmt = $this->conn->prepare("SELECT * FROM User WHERE Phone=?");
         $stmt->bind_param("s",$phone);
         $stmt->execute();
         $stmt->store_result();
         if($stmt->num_rows > 0)
         {
             $stmt->close();
             return "ok";
         }
         else
         {
         $stmt = $this->conn->prepare("SELECT * FROM Driver WHERE Phone=?");
         $stmt->bind_param("s",$phone);
         $stmt->execute();
         $stmt->store_result();
         if($stmt->num_rows > 0)
         {
             $stmt->close();
             return "ok";
         }
         else
         {
            $stmt->close();
             return "User not exists";
         }
         }
     }
     
      function CheckUserEmail($Email) {
         $stmt = $this->conn->prepare("SELECT * FROM User WHERE Email=?");
         $stmt->bind_param("s",$Email);
         $stmt->execute();
         $stmt->store_result();
         if($stmt->num_rows > 0)
         {
             $stmt->close();
             return "user not exists";
         }
         else
         {
            $stmt->close();
             return "ok";
         }
     }
     
      function CheckDriverEmail($Email) {
         $stmt = $this->conn->prepare("SELECT * FROM Driver WHERE Email=?");
         $stmt->bind_param("s",$Email);
         $stmt->execute();
         $stmt->store_result();
         if($stmt->num_rows > 0)
         {
             $stmt->close();
             return "Driver not exists";
         }
         else
         {
            $stmt->close();
             return "ok";
         }
     }
    
      function checkExistsUser($phone,$email) {
         $stmt = $this->conn->prepare("SELECT * FROM User WHERE Phone=?");
         $stmt->bind_param("s",$phone);
         $stmt->execute();
         $stmt->store_result();
         if($stmt->num_rows > 0)
         {
             $stmt->close();
             return "phone number exists";
         
         }
         else
         {
          $stmt->close();
          $stmt = $this->conn->prepare("SELECT * FROM User WHERE Email=?");
          $stmt->bind_param("s",$email);
          $stmt->execute();
          $stmt->store_result();
          if($stmt->num_rows > 0)
          {
              $stmt->close();
              return "email exists";
          }
          else
          {
             $stmt->close();
             return "ok";
          }
         }
     }
     
      /*
     * check driver exist
     * return true/false
     */
      function CheckDriver($phone){
         $stmt = $this->conn->prepare("SELECT * FROM Driver WHERE Phone=?");
         $stmt->bind_param("s",$phone);
         $stmt->execute();
         $stmt->store_result();
         if($stmt->num_rows > 0)
         {
             $stmt->close();
             return "ok";
         }else{
            $stmt = $this->conn->prepare("SELECT * FROM User WHERE Phone=?");
         $stmt->bind_param("s",$phone);
         $stmt->execute();
         $stmt->store_result();
         if($stmt->num_rows > 0)
         {
             $stmt->close();
             return "ok";
         }
         else
         {
              $stmt->close();
             return "Driver Exists";
         }
         }
     }
     
      function checkPhoneLocalDatabase($phone){
         $stmt = $this->conn->prepare("SELECT * FROM LocalDatabase WHERE Phone=?");
         $stmt->bind_param("s",$phone);
         $stmt->execute();
         $stmt->store_result();
         if($stmt->num_rows > 0)
         {
             $stmt->close();
             return "ok";
         }else{
              $stmt->close();
             return "Local Database Not Exist";
         }
     }
    
      function checkExistsDriver($phone,$email){
         $stmt = $this->conn->prepare("SELECT * FROM Driver WHERE Phone=?");
         $stmt->bind_param("s",$phone);
         $stmt->execute();
         $stmt->store_result();
         if($stmt->num_rows > 0)
         {
             $stmt->close();
             return "phone number exists";
         
         }
         else
         {
          $stmt->close();
          $stmt = $this->conn->prepare("SELECT * FROM Driver WHERE Email=?");
          $stmt->bind_param("s",$email);
          $stmt->execute();
          $stmt->store_result();
          if($stmt->num_rows > 0)
          {
              $stmt->close();
              return "email exists";
          }
          else
          {
             $stmt->close();
             return "ok";
          }
         }
     }
     
      public function checkToken($phone){
          $stmt = $this->conn->prepare("SELECT * FROM Token WHERE phone=?");
         $stmt->bind_param("s",$phone);
         $stmt->execute();
         $stmt->store_result();
         if($stmt->num_rows > 0)
         {
             $stmt->close();
             return true;
         }
         else
         {
             $stmt->close();
             return false;

         }
      }
      
      public function checkDriverForAadmin($phone){
           $stmt = $this->conn->prepare("SELECT * FROM Driver WHERE Phone=?");
         $stmt->bind_param("s",$phone);
         $stmt->execute();
         $stmt->store_result();
         if($stmt->num_rows > 0)
         {
             $stmt->close();
             return "ok";
         }else{
          $stmt->close();
             return "not";
         }
      }
     
      public function checkUserForAdmin($phone){
           $stmt = $this->conn->prepare("SELECT * FROM User WHERE Phone=?");
         $stmt->bind_param("s",$phone);
         $stmt->execute();
         $stmt->store_result();
         if($stmt->num_rows > 0)
         {
             $stmt->close();
             return "ok";
         }else{
          $stmt->close();
             return "not";
         }
      }
     
     //***********************for getting values***************************//
     
      function getDriverInfo($phone) {
         $stmt = $this->conn->prepare("SELECT * FROM Driver WHERE Phone=?");
         $stmt->bind_param("s",$phone);
         $stmt->execute();
         $result = $stmt->get_result()->fetch_assoc();
         $stmt->close();
         return $result;
     }
     
      function getAllDriver() {
         $result = $this->conn->query("SELECT * FROM Driver WHERE DriverStatus =1 ORDER BY Id DESC");
         $cabs = array();
         while($item = $result->fetch_assoc()){
         $cabs[] = $item;
         }
         return $cabs;
     }
     
      /*
      * get User info
      *return USER object if user exists
      *return NULL if user not exists
      */
      public function getUserInformation($email){
          $stmt = $this->conn->prepare("SELECT * FROM User Where Email=?");
          $stmt->bind_param("s",$email);

          if($stmt->execute()){
              $user = $stmt->get_result()->fetch_assoc();
              $stmt->close();
              return $user;
          }else{
              return false;
          }
      }
      
      public function getUserImage($phone){
          $stmt = $this->conn->prepare("SELECT userImage FROM User Where Phone=?");
          $stmt->bind_param("s",$phone);

          if($stmt->execute()){
              $user = $stmt->get_result()->fetch_assoc();
              $stmt->close();
              return $user;
          }else{
              return NULL;
          }
      }
      
      public function getLocalDatbase($phone){
          $stmt = $this->conn->prepare("SELECT * FROM LocalDatabase Where Phone=?");
          $stmt->bind_param("s",$phone);

          if($stmt->execute()){
              $user = $stmt->get_result()->fetch_assoc();
              $stmt->close();
              return $user;
          }else{
              return NULL;
          }
      }
      
      public function getRequestInfo($userphone,$driverphone,$status,$code){
            if($code==0){
             $stmt = $this->conn->prepare("SELECT * FROM OneWayBooking WHERE BookAccount=? AND CabDriver=? AND CabStatus=?");
             $stmt->bind_param("sss",$userphone,$driverphone,$status);
             $stmt->execute();
             $user = $stmt->get_result()->fetch_assoc();
             $stmt->close();
             return $user;
            }else if($code==1){
                $stmt = $this->conn->prepare("SELECT * FROM RoundWayBooking WHERE BookAccount=? AND CabDriver=? AND CabStatus=?");
             $stmt->bind_param("sss",$userphone,$driverphone,$status);
             $stmt->execute();
             $user = $stmt->get_result()->fetch_assoc();
             $stmt->close();
             return $user;
            }
          }
          
      public function getRatting($driverphone){
           $result = $this->conn->query("SELECT * FROM Rating WHERE CabDriver='$driverphone' AND Review IS NOT NULL ORDER BY Id DESC");
        $cabs = array();
        while($item = $result->fetch_assoc())
        {
            $cabs[] = $item;
        }
            return $cabs;
            
          }
          
      public function getRattingForUser($driverphone){
            $stmt = $this->conn->prepare("SELECT Count(*) as countRate, SUM(Rating)/COUNT(*) as rate FROM Rating WHERE CabDriver=? AND Review IS NOT NULL");
          $stmt->bind_param("s",$driverphone);

          if($stmt->execute()){
              $user = $stmt->get_result()->fetch_assoc();
              $stmt->close();
              return $user;
          }else{
              return NULL;
          }
            
          }
          
      public function getRattingByPhone($driverphone){
           
            $stmt = $this->conn->prepare("SELECT SUM(Rating)/COUNT(*) as rate FROM Rating WHERE CabDriver=? AND Review IS NOT NULL");
          $stmt->bind_param("s",$driverphone);

          if($stmt->execute()){
              $user = $stmt->get_result()->fetch_assoc();
              $stmt->close();
              return $user;
          }else{
              return NULL;
          }
          
          }
          
      public function getCabModel($driverphone){
             $stmt = $this->conn->query("SELECT * FROM CabDetails WHERE CabDriver='$driverphone'");
             $user = $stmt->fetch_assoc();
             $stmt->close();
             return $user;
          }
          
       public function getRequestData($driverphone,$date,$status,$code){
           	date_default_timezone_set('Asia/Kolkata');
          	$dateSS = date('Y-m-d H:i:s');
          	$dateHr = $this->conn->query("SELECT ADDTIME('$dateSS' , '-2:00:0.000000') AS DATE");
          	$Hours = $dateHr->fetch_assoc();
          	$Hour=$Hours["DATE"];
            if($code==0){
                $result = $this->conn->query("SELECT * FROM OneWayBooking WHERE CabDriver='$driverphone' AND CabStatus='$status' AND pickupDate='$date'");
                $cabs = array();
                while($item = $result->fetch_assoc())
                {
                    $cabs[] = $item;
                }
                    return $cabs;
            } else if($code==1){
                $result = $this->conn->query("SELECT * FROM RoundWayBooking WHERE CabDriver='$driverphone' AND CabStatus='$status' AND pickupDate='$date'");
                $cabs = array();
                while($item = $result->fetch_assoc())
                {
                    $cabs[] = $item;
                }
                    return $cabs;
            } else if($code==2){
                 $result = $this->conn->query("SELECT * FROM OneWayBooking WHERE CabDriver='$driverphone' AND CabStatus='$status' AND pickupDate > '$date'");
                $cabs = array();
                while($item = $result->fetch_assoc())
                {
                    $cabs[] = $item;
                }
                    return $cabs;
            }else if($code==3){
                 $result = $this->conn->query("SELECT * FROM RoundWayBooking WHERE CabDriver='$driverphone' AND CabStatus='$status' AND pickupDate > '$date'");
                $cabs = array();
                while($item = $result->fetch_assoc())
                {
                    $cabs[] = $item;
                }
                    return $cabs;
            }else if($code==4){
                 $result = $this->conn->query("SELECT * FROM OneWayBooking WHERE CabDriver='$driverphone' AND CabStatus='$status' AND RequestTime BETWEEN '$Hour' AND '$dateSS'");
                $cabs = array();
                while($item = $result->fetch_assoc())
                {
                    $cabs[] = $item;
                }
                    return $cabs;
            }else if($code==5){
                 $result = $this->conn->query("SELECT * FROM RoundWayBooking WHERE CabDriver='$driverphone' AND CabStatus='$status' AND RequestTime '$Hour' AND '$dateSS'");
                $cabs = array();
                if($result!=null)
                    while($item = $result->fetch_assoc())
                    {
                    $cabs[] = $item;
                }
                return $cabs;
            }
          }
          
          
      /*
      * get Driver info
      *return Driver object if driver exists
      *return NULL if driver not exists
      */
      public function getDriverInformation($email){
          $stmt = $this->conn->prepare("SELECT * FROM Driver Where Email=?");
          $stmt->bind_param("s",$email);

          if($stmt->execute()){
              $driver = $stmt->get_result()->fetch_assoc();
              $stmt->close();

              return $driver;
          }else
          {
              return NULL;
          }
      }

      /* get cabs
      *return list of cabs
      */
      public function getCab($CabType,$CabLocation){
         $result = $this->conn->query("SELECT CabDetails.Id,CabDetails.CabBrand,CabDetails.CabModel,CabDetails.CabNumber,CabDetails.CabImage,CabDetails.CabSitting,CabDetails.CabDriver,CabDetails.CabType,CabDetails.CabLocation FROM CabDetails,Driver WHERE CabDetails.CabType = '$CabType' AND CabDetails.CabLocation = '$CabLocation' AND Driver.Phone = CabDetails.CabDriver AND Driver.DriverStatus = 1 ORDER BY CabDetails.Id");
         $cabs = array();
         while($item = $result->fetch_assoc()){
         $cabs[] = $item;
      }
         return $cabs;

      }
      
      public function getCabAdmin($CabType,$CabLocation,$CabModel){
         $result = $this->conn->query("SELECT CabDetails.CabDriver FROM CabDetails,Driver WHERE CabDetails.CabType = '$CabType' AND CabDetails.CabLocation = '$CabLocation' AND CabDetails.CabModel = '$CabModel' AND Driver.Phone = CabDetails.CabDriver AND Driver.DriverStatus = 1 ORDER BY CabDetails.Id");
         $cabs = array();
         while($item = $result->fetch_assoc()){
         $cabs[] = $item['CabDriver'];
      }
         return $cabs;

      }

      /* get cabs by model
      *return list of cabs
      */
      public function getCabByModel($cabModel){
         $result = $this->conn->query("SELECT CabDetails.Id,CabDetails.CabBrand,CabDetails.CabModel,CabDetails.CabNumber,CabDetails.CabImage,CabDetails.CabSitting,CabDetails.CabDriver,CabDetails.CabType,CabDetails.CabLocation FROM CabDetails,Driver Where CabModel='$cabModel' AND CabDetails.CabDriver = Driver.Phone AND Driver.DriverStatus=1");
          $cabs = array();
        while($item = $result->fetch_assoc())
         {
            $cabs[] = $item;
          }
                return $cabs;

      }
      
      public function getRequestOfDriver(){
         $result = $this->conn->query("SELECT * FROM Driver Where DriverStatus=0");
          $driver = array();
        while($item = $result->fetch_assoc())
         {
            $driver[] = $item;
         }
         return $driver;

      }
      
      public function getTripBookingUser($BookAccount){
          $result = $this->conn->query("SELECT * FROM TripBooking WHERE BookAccount='$BookAccount' AND TripStatus=1 ORDER BY Id DESC");
             $cabs = array();
            while($item = $result->fetch_assoc())
            {
                $cabs[] = $item;
            }
            return $cabs;
      }
      
      public function getTripBookingDriver($Driver){
          $result = $this->conn->query("SELECT * FROM TripBooking WHERE CabDriver='$Driver' AND TripStatus=1 ORDER BY Id DESC");
             $cabs = array();
            while($item = $result->fetch_assoc())
            {
                $cabs[] = $item;
            }
            return $cabs;
      }

      public function getTripBookingUserbyDate($BookAccount,$date){
          $result = $this->conn->query("SELECT * FROM TripBooking WHERE BookAccount='$BookAccount' AND pickupDate >='$date' AND TripStatus=1 ORDER BY Id DESC");
             $cabs = array();
            while($item = $result->fetch_assoc())
            {
                $cabs[] = $item;
            }
            return $cabs;
      }
      
      public function getTripBookingDriverbyDate($Driver,$date){
          $result = $this->conn->query("SELECT * FROM TripBooking WHERE CabDriver='$Driver' AND pickupDate >='$date' AND TripStatus=1 ORDER BY Id DESC");
             $cabs = array();
            while($item = $result->fetch_assoc())
            {
                $cabs[] = $item;
            }
            return $cabs;
      }
      
      public function getBookingCount($cabDriver,$code,$date){
          if($code==0){
            $query ="SELECT COUNT(*) FROM OneWayBooking WHERE CabDriver='".$cabDriver."' AND CabStatus IN(0,2) AND pickupDate >= '$date'";
            $result = $this->conn->query($query);
            $count =$result->fetch_assoc();
            return $count['COUNT(*)'];}
          else if($code==1){
            $query ="SELECT COUNT(*) FROM RoundWayBooking WHERE CabDriver='".$cabDriver."' AND CabStatus IN(0,2) AND pickupDate >= '$date'";
            $result = $this->conn->query($query);
            $count =$result->fetch_assoc();
            return $count['COUNT(*)'];
        }
          else if($code==2){
            $query ="SELECT COUNT(*) FROM OneWayBooking WHERE CabDriver='".$cabDriver."' AND CabStatus IN(0,2) AND pickupDate >= '$date'";
            $result = $this->conn->query($query);
            $count =$result->fetch_assoc();
            return $count['COUNT(*)'];}
          else if($code==3){
            $query ="SELECT COUNT(*) FROM RoundWayBooking WHERE CabDriver='".$cabDriver."' AND CabStatus IN(0,2) AND pickupDate >= '$date'";
            $result = $this->conn->query($query);
            $count =$result->fetch_assoc();
            return $count['COUNT(*)'];
        } 
      }
      
      public function getCabDetails($Phone){
        $stmt = $this->conn->query("SELECT * FROM CabDetails WHERE CabDriver='$Phone'");
        $user = $stmt->fetch_assoc();
        $stmt->close();
        return $user;
      }
      
      /*
       *GET NEARBY STORE
       *return List Of Store or False
       */
      public function getNearbyStore($lat,$lng){
           
           $result = $this->conn->query("SELECT id,name,lat,lng,ROUND(111.045 * DEGREES(ACOS(COS(RADIANS($lat)) * COS(RADIANS(lat))  * COS(RADIANS(lng) - RADIANS($lng)) + SIN(RADIANS($lat)) * SIN(RADIANS(lat)))),2)AS distance_in_km FROM Store ORDER BY distance_in_km ASC") or die($this->conn->error);
           $stores = array();
           while($store = $result->fetch_assoc())
           $stores[] = $store;
           return $stores;
           
       }
       
      /*
       *GET TOKEN
       *return Result or False
       */
      public function getToken($phone,$isServerToken){
           $stmt = $this->conn->prepare("SELECT * FROM `Token` WHERE phone=? AND isServerToken=?") or die($this->conn->error);
           $stmt->bind_param("ss",$phone,$isServerToken);
           $stmt->execute();
           $token = $stmt->get_result()->fetch_assoc();
           $stmt->close();
           
           return $token;
       }
       
      public function getTripBooking($id){
          $stmt = $this->conn->prepare("SELECT * FROM TripBooking WHERE Id ='$id'");
             $stmt->execute();
             $user = $stmt->get_result()->fetch_assoc();
             $stmt->close();
             return $user;
      }
      
      public function getDriverInfoForAdmin($phone){
          $stmt = $this->conn->prepare("SELECT Driver.Name,Driver.Phone,CabDetails.CabModel,CabDetails.CabBrand,CabDetails.CabNumber FROM Driver,CabDetails WHERE Driver.Phone =? AND CabDetails.CabDriver=?");
          $stmt->bind_param("ss",$phone,$phone);
          $data = array();
          if($stmt->execute()){
              $driver = $stmt->get_result()->fetch_assoc();
              $stmt->close();
              
              $data["DriverName"]=$driver["Name"];
              $data["DriverPhone"]=$driver["Phone"];
              $data["DriverCabModel"]=$driver["CabModel"];
              $data["DriverCabBrand"]=$driver["CabBrand"];
              $data["DriverCabNumber"]=$driver["CabNumber"];
              
              $stmt = $this->conn->prepare("SELECT TripBooking.sourceAddress,TripBooking.destinationAddress,TripBooking.StartTrip,TripBooking.BookAccount FROM TripBooking WHERE CabDriver=? AND TripStatus =3");
              $stmt->bind_param("s",$phone);
              
              if($stmt->execute()){
                $driver = $stmt->get_result()->fetch_assoc();
                $stmt->close();
                
                $data["sourceAddress"]=$driver["sourceAddress"];
                $data["destinationAddress"]=$driver["destinationAddress"];
                $data["StartTrip"]=$driver["StartTrip"];
                $data["BookAccount"]=$driver["BookAccount"];
                
                $stmt = $this->conn->prepare("SELECT COUNT(*) AS TotalTrip FROM TripBooking WHERE CabDriver=? AND TripStatus =1");
                $stmt->bind_param("s",$phone);
              
                if($stmt->execute()){
                    $driver = $stmt->get_result()->fetch_assoc();
                    $stmt->close();
                
                    $data["TotalTrip"]=$driver["TotalTrip"];
                    
                    $stmt = $this->conn->prepare("SELECT * FROM User WHERE Phone=?");
                    $stmt->bind_param("s",$data["BookAccount"]);
              
                    if($stmt->execute()){
                        $driver = $stmt->get_result()->fetch_assoc();
                        $stmt->close();
                        $data["Name"]=$driver["Name"];
                        $data["Email"]=$driver["Email"];
                        return $data;
                    }else{
                        $stmt->close();
                        return $data;
                    }
                
                }else{
                    $stmt->close();
                    return $data;
                }
              }else{
                $stmt->close();
                return $data;
              }
          }else{
              $stmt->close();
              return false;
          }
          
      }
      
      public function getDriverCheckStatus($phone){
          $stmt = $this->conn->prepare("SELECT COUNT(*) AS result FROM TripBooking WHERE CabDriver=? AND TripStatus = 3");
         $stmt->bind_param("s",$phone);
              
                    if($stmt->execute()){
                        $driver = $stmt->get_result()->fetch_assoc();
                        $stmt->close();
                        return $driver;
                    }else{
                        $stmt->close();
                        return false;
                    }
      }
      
      public function getDriverTripDetail($phone){
          $stmt = $this->conn->prepare("SELECT * FROM TripBooking WHERE CabDriver=? AND TripStatus = 3");
         $stmt->bind_param("s",$phone);
              
                    if($stmt->execute()){
                        $driver = $stmt->get_result()->fetch_assoc();
                        $stmt->close();
                        return $driver;
                    }else{
                        $stmt->close();
                        return false;
                    }
      }
      
      //user information
      public function getUsersInfoForAdmin($phone){
          $stmt = $this->conn->prepare("SELECT Name,Email,Phone,userImage FROM User WHERE Phone =?");
          $stmt->bind_param("s",$phone);
          if($stmt->execute()){
              $user = $stmt->get_result()->fetch_assoc();
              $stmt->close();
              return $user;
          }else{
              $stmt->close();
              return false;
          }
          
      }
      
      public function getUsersCheckStatus($phone){
          $stmt = $this->conn->prepare("SELECT COUNT(*) AS result FROM TripBooking WHERE BookAccount=? AND TripStatus = 3");
          $stmt->bind_param("s",$phone);
          if($stmt->execute()){
              $user = $stmt->get_result()->fetch_assoc();
              $stmt->close();
              return $user;
          }else{
              $stmt->close();
              return false;
          }
          
      }
    
      public function getUsersForAdmin(){
         $result = $this->conn->query("SELECT Name,Email,Phone,userImage FROM User ORDER BY Id DESC");
         $user = array();
         while($item = $result->fetch_assoc()){
         $user[] = $item;
      }
         return $user;

      }
      
      public function getUserTrips($phone){}
      
      public function getUsersInfoForAdminStatus($phone){
            
          $stmt = $this->conn->prepare("SELECT TripBooking.sourceAddress,TripBooking.destinationAddress,TripBooking.StartTrip,TripBooking.CabDriver FROM TripBooking WHERE BookAccount=? AND TripStatus =3");
          $stmt->bind_param("s",$phone);
          $data = array();
          if($stmt->execute()){
              $driver = $stmt->get_result()->fetch_assoc();
              $stmt->close();
              
                $data["sourceAddress"]=$driver["sourceAddress"];
                $data["destinationAddress"]=$driver["destinationAddress"];
                $data["StartTrip"]=$driver["StartTrip"];
                $data["CabDriver"]=$driver["CabDriver"];
              
              $stmt = $this->conn->prepare("SELECT Driver.Name,Driver.Phone,CabDetails.CabModel,CabDetails.CabBrand,CabDetails.CabNumber FROM Driver,CabDetails WHERE Driver.Phone =? AND CabDetails.CabDriver=?");
              $stmt->bind_param("ss",$data["CabDriver"],$data["CabDriver"]);
              
              if($stmt->execute()){
                $driver = $stmt->get_result()->fetch_assoc();
                $stmt->close();
                
                $data["DriverName"]=$driver["Name"];
                $data["DriverPhone"]=$driver["Phone"];
                $data["DriverCabModel"]=$driver["CabModel"];
                $data["DriverCabBrand"]=$driver["CabBrand"];
                $data["DriverCabNumber"]=$driver["CabNumber"];
                
                $stmt = $this->conn->prepare("SELECT COUNT(*) AS TotalTrip FROM TripBooking WHERE BookAccount=? AND TripStatus =1");
                $stmt->bind_param("s",$phone);
              
                if($stmt->execute()){
                    $driver = $stmt->get_result()->fetch_assoc();
                    $stmt->close();
                
                    $data["TotalTrip"]=$driver["TotalTrip"];
                    
                    $stmt = $this->conn->prepare("SELECT * FROM User WHERE Phone=?");
                    $stmt->bind_param("s",$phone);
              
                    if($stmt->execute()){
                        $driver = $stmt->get_result()->fetch_assoc();
                        $stmt->close();
                        $data["Name"]=$driver["Name"];
                        $data["Email"]=$driver["Email"];
                        return $data;
                    }else{
                        $stmt->close();
                        return $data;
                    }
                
                }else{
                    $stmt->close();
                    return $data;
                }
              }else{
                $stmt->close();
                return $data;
              }
          }else{
              $stmt->close();
              return false;
          }
          
      }
      
      //***************for inserting values*****************************//
    
      public function insertRating($CabDriver,$BookAccount,$Name,$Image,$rating,$Review){
     $stmt =   $this->conn->prepare("INSERT INTO `Rating`( `CabDriver`,`BookAccount`, `Name`,`Image`,`Rating`,`Review`) VALUES (?,?,?,?,?,?)") or die($this->conn->error);
          
    $stmt->bind_param("ssssss",$CabDriver,$BookAccount,$Name,$Image,$rating,$Review);
    $result = $stmt->execute();
    $stmt->close();
    if($result){
      return true;
    }else{
      return false;
      }
    }
    
     public function insertLocalDatbase($Phone,$UserDataOneWay,$CabOneWay,$UserDataRoundWay,$CabRoundWay,$NotificationDB,$DriverPhone,$MapStatus){
     $stmt =   $this->conn->prepare("INSERT INTO `LocalDatabase`(`Phone`, `UserDataOneWay`, `CabOneWay`, `UserDataRoundWay`, `CabRoundWay`, `NotificationDB`, `DriverPhone`, `MapStatus`) VALUES (?,?,?,?,?,?,?,?)") or die($this->conn->error);
          
    $stmt->bind_param("ssssssss",$Phone,$UserDataOneWay,$CabOneWay,$UserDataRoundWay,$CabRoundWay,$NotificationDB,$DriverPhone,$MapStatus);
    $result = $stmt->execute();
    $stmt->close();
    if($result){
      return true;
    }else{
      return false;
      }
    }
       
      /*
      *Regist new User
      *return USER object if user was created
      *return error message if have exception
      */
      public function registerNewUser($username,$email,$phone,$password,$image){
             $stmt = $this->conn->prepare("INSERT INTO User(`Name`,`Email`,`Phone`,`Password`,`userImage`) VALUES(?,?,?,?,?)");
         $stmt->bind_param("sssss",$username,$email,$phone,$password,$image);
         $result=$stmt->execute();
         $stmt->close();

         if($result){
             $stmt = $this->conn->prepare("SELECT * FROM User WHERE Email = ?");
             $stmt->bind_param("s",$email);
             $stmt->execute();
             $user = $stmt->get_result()->fetch_assoc();
             $stmt->close();
             return $user;
         }
         else
         {
             return false;

         }
      }
      
      /*
      *Regist new Driver
      *return Driver object if Driver was created
      *return error message if have exception
      */
      public function registerNewDriver($name,$email,$phone,$password,$driverImage,$aadharNumber,$aadharImage,$licenseImage,$driverStatus){
             $stmt = $this->conn->prepare("INSERT INTO Driver( `Name`, `Email`, `Phone`, `Password`, `driverImage`, `AadharNumber`, `AadharImage`, `LicenseImage`, `DriverStatus`) VALUES(?,?,?,?,?,?,?,?,?)");
         $stmt->bind_param("sssssssss",$name,$email,$phone,$password,$driverImage,$aadharNumber,$aadharImage,$licenseImage,$driverStatus);
         $result=$stmt->execute();
         $stmt->close();

         if($result){
             $stmt = $this->conn->prepare("SELECT * FROM Driver WHERE Email = ?");
             $stmt->bind_param("s",$email);
             $stmt->execute();
             $driver = $stmt->get_result()->fetch_assoc();
             $stmt->close();
             return $driver;
         }
         else
         {
             return false;

         }
      }
      
      /*
      *add new cab
      */
      public function insertNewCab($cabBrand,$cabModel,$CabNumber,$cabImage,$cabSitting,$cabType,$cabCity,$cabDriver){
             $stmt = $this->conn->prepare("INSERT INTO `CabDetails`( `CabBrand`, `CabModel`, `CabNumber`, `CabImage`, `CabSitting`, `CabDriver`, `CabType`, `CabLocation`) VALUES(?,?,?,?,?,?,?,?)");
         $stmt->bind_param("ssssssss",$cabBrand,$cabModel,$CabNumber,$cabImage,$cabSitting,$cabDriver,$cabType,$cabCity);
         $result=$stmt->execute();
         $stmt->close();
         if($result){
             return "ok";
         }
         else
         {
             return "error while insert in database Try Again!";
         }
      }
      
     
        /* INSERT NEW Booking
      *return TRUE OR FALSE
      */
      public function insertNewOneWayBooking($fullName,$phoneNumber,$email,$sourceAddress,$destinationAddress,$pickupDate,$pickupTime,$source,$destination,$Cabs,$BookAccount,$cabFare,$cabDriver,$cabStatus,$cabModel,$cabTnxId)
      {
          	
          	date_default_timezone_set('Asia/Kolkata');
          	$date = date('Y-m-d H:i:s');
        $stmt = $this->conn->prepare("INSERT INTO `OneWayBooking`(`fullName`, `phoneNumber`, `email`, `sourceAddress`, `destinationAddress`, `pickupDate`, `pickupTime`, `source`, `destination`, `Cabs`, `BookAccount`, `CabFare`, `CabDriver`, `CabStatus`, `CabModel`,`CabTnxId`,`RequestTime`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")or die($this->conn->error);
         $stmt->bind_param("sssssssssssssssss",$fullName,$phoneNumber,$email,$sourceAddress,$destinationAddress,$pickupDate,$pickupTime,$source,$destination,$Cabs,$BookAccount,$cabFare,$cabDriver,$cabStatus,$cabModel,$cabTnxId,$date);
         $result = $stmt->execute();
         $stmt->close();

         if($result)
         {
             return true;
         }
         else
         return false;
      }
      
      public function insertNewRoundWayBooking($fullName,$phoneNumber,$email,$sourceAddress,$destinationAddress,$pickupDate,$dropDate,$pickupTime,$source,$destination,$Cabs,$BookAccount,$cabFare,$cabDriver,$cabStatus,$cabModel,$cabTnxId)
      {
          date_default_timezone_set('Asia/Kolkata');
          	$date = date('Y-m-d H:i:s');
          	
        $stmt = $this->conn->prepare("INSERT INTO `RoundWayBooking`(`fullName`, `phoneNumber`, `email`, `sourceAddress`, `destinationAddress`, `pickupDate`, `dropDate`, `pickupTime`, `source`, `destination`, `Cabs`, `BookAccount`, `CabFare`, `CabDriver`, `CabStatus`, `CabModel`,`CabTnxId`,`RequestTime`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")or die($this->conn->error);
         $stmt->bind_param("ssssssssssssssssss",$fullName,$phoneNumber,$email,$sourceAddress,$destinationAddress,$pickupDate,$dropDate,$pickupTime,$source,$destination,$Cabs,$BookAccount,$cabFare,$cabDriver,$cabStatus,$cabModel,$cabTnxId,$date);
         $result = $stmt->execute();
         $stmt->close();

         if($result)
         {
             return true;
         }
         else
         return false;
      }
      
      public function insertNewTripBooking($fullName,$phoneNumber,$email,$sourceAddress,$destinationAddress,$pickupDate,$dropDate,$pickupTime,$source,$destination,$Cabs,$BookAccount,$cabFare,$cabDriver,$cabStatus,$cabModel,$cabTnxId,$StartTrip,$DropTrip,$TripStatus,$PickUpMeter,$DropMeter,$TripToll,$TripCode)
      {
        $stmt = $this->conn->prepare("INSERT INTO `TripBooking`(`fullName`, `phoneNumber`, `email`, `sourceAddress`, `destinationAddress`, `pickupDate`, `dropDate`, `pickupTime`, `source`, `destination`, `Cabs`, `BookAccount`, `CabFare`, `CabDriver`, `CabStatus`, `CabModel`, `CabTnxId`, `StartTrip`, `DropTrip`, `TripStatus`, `PickUpMeter`, `DropMeter`, `TripToll`, `TripCode`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")or die($this->conn->error);
         $stmt->bind_param("ssssssssssssssssssssssss",$fullName,$phoneNumber,$email,$sourceAddress,$destinationAddress,$pickupDate,$dropDate,$pickupTime,$source,$destination,$Cabs,$BookAccount,$cabFare,$cabDriver,$cabStatus,$cabModel,$cabTnxId,$StartTrip,$DropTrip,$TripStatus,$PickUpMeter,$DropMeter,$TripToll,$TripCode);
         $result = $stmt->execute();
         $stmt->close();

         if($result)
         {
             $stmt = $this->conn->prepare("SELECT * FROM TripBooking WHERE CabTnxId =?");
             $stmt->bind_param("s",$cabTnxId);
             $stmt->execute();
             $user = $stmt->get_result()->fetch_assoc();
             $stmt->close();
             return $user;
         }
         else
         return false;
      }
      
      /*
      *INSERT OR UPDATE TOKEN
      *RETURN Token or FALSE
      */
      public function insertToken($phone,$token,$isServerToken){
           $stmt = $this->conn->prepare("INSERT INTO `Token`(`phone`, `token`, `isServerToken`) VALUES (?,'$token',?)");
         $stmt->bind_param("ss",$phone,$isServerToken);
         $result = $stmt->execute();
         $stmt->close();
         if($result)
         {
             return true;
         }
         else
         {
             return false;
         }
        
      }
      
      //**************for updating values functions***********************//
      
      public function updateCabTnxId($id,$tnxId,$code){
          if($code==1){
          $stmt = $this->conn->prepare("UPDATE OneWayBooking SET CabTnxId=?  WHERE Id=?");
             $stmt->bind_param("ss",$tnxId,$id);
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
          }else if($code==2){
              $stmt = $this->conn->prepare("UPDATE RoundWayBooking SET CabTnxId=?  WHERE Id=?");
             $stmt->bind_param("ss",$tnxId,$id);
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
          }
      }
     
      /*
      *update user password
      */
      public function updatePassword($password,$phone){
            
          $stmt = $this->conn->prepare("UPDATE `User` SET Password=? Where Phone=?");
          $stmt->bind_param("ss",$password,$phone);
         $result= $stmt->execute();
          if($result){
              $stmt->close();
              return "ok";
          }else{
                $stmt->close();
              return "Error While Updating Your Password Try Again!";
          }
          
        }
      
      public function updateLocalDatbase($Phone,$UserDataOneWay,$CabOneWay,$UserDataRoundWay,$CabRoundWay,$NotificationDB,$DriverPhone,$MapStatus){
         $stmt =   $this->conn->prepare("UPDATE `LocalDatabase` SET `Phone`=?,`UserDataOneWay`=?,`CabOneWay`=?,`UserDataRoundWay`=?,`CabRoundWay`=?,`NotificationDB`=?,`DriverPhone`=?,`MapStatus`=? WHERE `Phone`=?") or die($this->conn->error);
          
        $stmt->bind_param("sssssssss",$Phone,$UserDataOneWay,$CabOneWay,$UserDataRoundWay,$CabRoundWay,$NotificationDB,$DriverPhone,$MapStatus,$Phone);
        $result = $stmt->execute();
        $stmt->close();
        if($result){
         return true;
        }else{
         return false;
        }
    }
    
      /*
      *update driver password
      */
      public function updateDriverPassword($password,$phone){
            
          $stmt = $this->conn->prepare("UPDATE `Driver` SET Password=? Where Phone=?");
          $stmt->bind_param("ss",$password,$phone);
         $result= $stmt->execute();
          if($result){
              $stmt->close();
              return "ok";
          }else{
                $stmt->close();
              return "Error While Updating Your Password Try Again!";
          }
          
        }
        
      
      public function updateDriverStatus($code,$phone){
            
          $stmt = $this->conn->prepare("UPDATE `Driver` SET DriverStatus=? Where Phone=?");
          $stmt->bind_param("ss",$code,$phone);
         $result= $stmt->execute();
          if($result){
              $stmt->close();
              return "ok";
          }else{
                $stmt->close();
              return "Error While Updating Your Status Try Again!";
          }
          
        }
          
      public function updateRequest($id,$status,$phoneUser,$model,$code,$phoneDriver){
              if($code==0){
                if($status==1){
             $stmt = $this->conn->prepare("UPDATE OneWayBooking SET CabStatus=?,CabDriver=?  WHERE Id=?");
             $stmt->bind_param("sss",$status,$phoneDriver,$id);
             if($stmt->execute()){
             $stmt->close();
              $stmt = $this->conn->prepare("DELETE FROM OneWayBooking WHERE BookAccount=? AND CabStatus IN(0,2) AND CabModel=?");
             $stmt->bind_param("ss",$phoneUser,$model);
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
             }else{
             $stmt->close();
             return false;
             }}
                else if($status==2){
             $stmt = $this->conn->prepare("UPDATE OneWayBooking SET CabStatus=?  WHERE Id=?");
             $stmt->bind_param("ss","3",$id);
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
             }
             else if($status==3){
                    $stmt = $this->conn->prepare("SELECT * FROM OneWayBooking WHERE BookAccount=? AND CabModel=?");
                    $stmt->bind_param("ss",$phoneUser,$model);
                    $stmt->execute();
                    $stmt->store_result();
                    if($stmt->num_rows == 1)
                    {
                        $stmt->close();
                        $stmt = $this->conn->prepare("SELECT * FROM OneWayBooking WHERE BookAccount=? AND CabModel=?");
                        $stmt->bind_param("ss",$phoneUser,$model);
                        $stmt->execute();
                        $cc = array();
                        $cc = $stmt->get_result()->fetch_assoc();
                        $c = json_decode($cc["CabTnxId"]);
                        if($c->TxnStatus=="TXN_SUCCESS" and $c->TxnType=="Receiving"){
                            $ran = $this->generateRandomString(10,false,true,true,'');
                            $amount = $c->TnxAmount;
                             $ch = $this->refundApply($c->OrderId,$c->TxnId,$ran,$amount);
                            $c->RefundId = $ran;
                            $c->TnxAmount=$amount;
                            $p = json_decode($ch);
                            if($p->body->resultInfo->resultStatus=="TXN_FAILURE"){
                                $c->TxnStatus = "TXN_FAILURE";
                                $c->TxnType="Refund";
                                $this->insertNewTripBooking($cc["fullName"],$cc["phoneNumber"],$cc["email"],$cc["sourceAddress"],$cc["destinationAddress"],$cc["pickupDate"],"00-00-0000",$cc["pickupTime"],$cc["source"],$cc["destination"],$cc["Cabs"],$cc["BookAccount"],$cc["CabFare"],$cc["CabDriver"],$cc["CabStatus"],$cc["CabModel"],json_encode($c),"00-00-0000","00-00-0000",5,0,0,0,5);
                                $stmt = $this->conn->prepare("DELETE FROM OneWayBooking WHERE Id=?");
                                $stmt->bind_param("s",$id);
                                if($stmt->execute()){
                                    $stmt->close();
                                    return true;
                                }
                                else{
                                    $stmt->close();
                                    return false;
                                }
                        }
                        else if($p->body->resultInfo->resultStatus=="PENDING"){
                            $c->TxnStatus = "PENDING";
                            $c->TxnType="Refund";
                            $this->insertNewTripBooking($cc["fullName"],$cc["phoneNumber"],$cc["email"],$cc["sourceAddress"],$cc["destinationAddress"],$cc["pickupDate"],"00-00-0000",$cc["pickupTime"],$cc["source"],$cc["destination"],$cc["Cabs"],$cc["BookAccount"],$cc["CabFare"],$cc["CabDriver"],$cc["CabStatus"],$cc["CabModel"],json_encode($c),"00-00-0000","00-00-0000",5,0,0,0,5);
                            $stmt = $this->conn->prepare("DELETE FROM OneWayBooking WHERE Id=?");
                            $stmt->bind_param("s",$id);
                            if($stmt->execute()){
                                $stmt->close();
                                return true;
                            }
                            else{
                                $stmt->close();
                                return false;
                            }
                    }
     }
                    }else{
                    $stmt = $this->conn->prepare("DELETE FROM OneWayBooking WHERE Id=?");
                    $stmt->bind_param("s",$id);
                    if($stmt->execute()){
                        $stmt->close();
                        return true;
                    }
                    else{
                        $stmt->close();
                        return false;
                    }
                    }
                }
             else if($status==4){
                    $stmt = $this->conn->prepare("DELETE FROM OneWayBooking WHERE Id=?");
                    $stmt->bind_param("s",$id);
                    if($stmt->execute()){
                        $stmt->close();
                        return true;
                    }else{
                        $stmt->close();
                        return false;
                    }
                }
              }
              else if($code==1){
                if($status==1){
                        $stmt = $this->conn->prepare("UPDATE RoundWayBooking SET CabStatus=?,CabDriver=?  WHERE Id=?");
                        $stmt->bind_param("sss",$status,$phoneDriver,$id);
                        if($stmt->execute()){
                            $stmt->close();
                             $stmt = $this->conn->prepare("DELETE FROM RoundWayBooking WHERE BookAccount=? AND CabStatus IN(0,2) AND CabModel=?");
                                 $stmt->bind_param("ss",$phoneUser,$model);
                                    if($stmt->execute()){
                                         $stmt->close();
                                         return true;
                                    }else{
                                        $stmt->close();
                                        return false;
                                    }
                        }else{
                            $stmt->close();
                            return false;
                        }}
                else if($status==2){
                    $stmt = $this->conn->prepare("UPDATE RoundWayBooking SET CabStatus=?  WHERE Id=?");
             $stmt->bind_param("ss","3",$id);
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
                    
                }
                else if($status==3){
                $stmt = $this->conn->prepare("SELECT * FROM RoundWayBooking WHERE BookAccount=? AND CabModel=?");
                    $stmt->bind_param("ss",$phoneUser,$model);
                    $stmt->execute();
                    $stmt->store_result();
                    if($stmt->num_rows == 1)
                    {
                        $stmt->close();
                        $stmt = $this->conn->prepare("SELECT * FROM RoundWayBooking WHERE BookAccount=? AND CabModel=?");
                        $stmt->bind_param("ss",$phoneUser,$model);
                        $stmt->execute();
                        $cc = array();
                        $cc = $stmt->get_result()->fetch_assoc();
                        $c = json_decode($cc["CabTnxId"]);
                        if($c->TxnStatus=="TXN_SUCCESS" and $c->TxnType=="Receiving"){
                            $ran = $this->generateRandomString(10,false,true,true,'');
                            $amount = $c->TnxAmount;
                             $ch = $this->refundApply($c->OrderId,$c->TxnId,$ran,$amount);
                            $c->RefundId = $ran;
                            $c->TnxAmount=$amount;
                            $p = json_decode($ch);
                            if($p->body->resultInfo->resultStatus=="TXN_FAILURE"){
                                $c->TxnStatus = "TXN_FAILURE";
                                $c->TxnType="Refund";
                                $this->insertNewTripBooking($cc["fullName"],$cc["phoneNumber"],$cc["email"],$cc["sourceAddress"],$cc["destinationAddress"],$cc["pickupDate"],$cc["dropDate"],$cc["pickupTime"],$cc["source"],$cc["destination"],$cc["Cabs"],$cc["BookAccount"],$cc["CabFare"],$cc["CabDriver"],$cc["CabStatus"],$cc["CabModel"],json_encode($c),"00-00-0000","00-00-0000",5,0,0,0,5);
                                $stmt = $this->conn->prepare("DELETE FROM RoundWayBooking WHERE Id=?");
                                $stmt->bind_param("s",$id);
                                if($stmt->execute()){
                                    $stmt->close();
                                    return true;
                                }
                                else{
                                    $stmt->close();
                                    return false;
                                }
                        }
                        else if($p->body->resultInfo->resultStatus=="PENDING"){
                            $c->TxnStatus = "PENDING";
                            $c->TxnType="Refund";
                            $this->insertNewTripBooking($cc["fullName"],$cc["phoneNumber"],$cc["email"],$cc["sourceAddress"],$cc["destinationAddress"],$cc["pickupDate"],$cc["dropDate"],$cc["pickupTime"],$cc["source"],$cc["destination"],$cc["Cabs"],$cc["BookAccount"],$cc["CabFare"],$cc["CabDriver"],$cc["CabStatus"],$cc["CabModel"],json_encode($c),"00-00-0000","00-00-0000",5,0,0,0,5);
                            $stmt = $this->conn->prepare("DELETE FROM RoundWayBooking WHERE Id=?");
                            $stmt->bind_param("s",$id);
                            if($stmt->execute()){
                                $stmt->close();
                                return true;
                            }
                            else{
                                $stmt->close();
                                return false;
                            }
                    }
     }
                    }else{
                    $stmt = $this->conn->prepare("DELETE FROM RoundWayBooking WHERE Id=?");
                    $stmt->bind_param("s",$id);
                    if($stmt->execute()){
                        $stmt->close();
                        return true;
                    }
                    else{
                        $stmt->close();
                        return false;
                    }
                    }
                }
                else if($status==4){
                    $stmt = $this->conn->prepare("DELETE FROM RoundWayBooking WHERE Id=?");
                    $stmt->bind_param("s",$id);
                    if($stmt->execute()){
                        $stmt->close();
                        return true;
                    }else{
                        $stmt->close();
                        return false;
                    }
                }
            }
        }
      
      public function updateDropMeterTripBooking($id,$DropMeter){
          $stmt = $this->conn->prepare("UPDATE TripBooking SET DropMeter=?  WHERE Id=?");
             $stmt->bind_param("ss",$DropMeter,$id);
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
      }
      
      public function updateDropTripBooking($id,$DropTrip){
          $stmt = $this->conn->prepare("UPDATE TripBooking SET DropTrip=?  WHERE Id=?");
             $stmt->bind_param("ss",$DropTrip,$id);
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
      }
      
      public function updateFareTripBooking($id,$CabFare,$CabTnxId){
          $stmt = $this->conn->prepare("UPDATE TripBooking SET CabFare=?,CabTnxId =?  WHERE Id=?");
             $stmt->bind_param("sss",$CabFare,$CabTnxId,$id);
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
      }
      
      public function updateTripStatusBooking($id,$TripStatus){
          $stmt = $this->conn->prepare("UPDATE TripBooking SET TripStatus=?  WHERE Id=?");
             $stmt->bind_param("ss",$TripStatus,$id);
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
      }
      
      public function updateTripTollBooking($id,$TripToll){
          $stmt = $this->conn->prepare("UPDATE TripBooking SET TripToll=?  WHERE Id=?");
             $stmt->bind_param("ss",$TripToll,$id);
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
      }
      
      public function updateTripDataBooking($id,$TripToll,$TripStatus,$DropTrip,$DropMeter,$NightStay){
          $stmt = $this->conn->prepare("UPDATE TripBooking SET TripToll=?, TripStatus=?,DropTrip=?,DropMeter=?,NightStay=?  WHERE Id=?");
             $stmt->bind_param("ssssss",$TripToll,$TripStatus,$DropTrip,$DropMeter,$NightStay,$id);
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
      }
      
      public function updateUser($id,$Name,$oldPhone,$Phone,$image,$Email){
              $stmt = $this->conn->prepare("UPDATE User SET Name=? ,Phone=?,userImage=?,Email=?  WHERE Id=?");
             $stmt->bind_param("sssss",$Name,$Phone,$image,$Email,$id);
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
      }
      
      public function updatePhoneOneWayBooking($oldPhone,$Phone,$code){
          if($code==0){ 
              $stmt = $this->conn->prepare("UPDATE OneWayBooking SET BookAccount=? WHERE BookAccount=?");
             $stmt->bind_param("ss",$Phone,$oldPhone);
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
                 $stmt->close();
                 return false;
             }
          }
          else if($code==1){
               $stmt = $this->conn->prepare("UPDATE OneWayBooking SET CabDriver=? WHERE CabDriver=?");
             $stmt->bind_param("ss",$Phone,$oldPhone);
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
          }
      }
      
      public function updateCabDetails($Phone,$oldPhone){
              $stmt = $this->conn->prepare("UPDATE CabDetails SET CabDriver=? WHERE CabDriver=?");
             $stmt->bind_param("ss",$Phone,$oldPhone);
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
          
      }
      
      public function updatePhoneRoundWayBooking($oldPhone,$Phone,$code){
          if($code==0){
      $stmt = $this->conn->prepare("UPDATE RoundWayBooking SET BookAccount=? WHERE BookAccount=?");
             $stmt->bind_param("ss",$Phone,$oldPhone);
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
          }
          else if($code==1){
              $stmt = $this->conn->prepare("UPDATE RoundWayBooking SET CabDriver=? WHERE CabDriver=?");
             $stmt->bind_param("ss",$Phone,$oldPhone);
             if($stmt->execute()){
            $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
          }
      }
      
      public function updatePhoneToken($oldPhone,$Phone,$code){
            if($code==0){ $stmt = $this->conn->prepare("UPDATE Token SET phone=? WHERE phone=?");
             $stmt->bind_param("ss",$Phone,$oldPhone);
             if($stmt->execute()){
             $stmt->close();
             return true;}else{
             $stmt->close();
             return false;
             }
            } else if($code==1){
                  $stmt = $this->conn->prepare("UPDATE Token SET phone=? WHERE phone=?");
             $stmt->bind_param("ss",$Phone,$oldPhone);
             if($stmt->execute()){
            $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
            }
        }
        
      public function updatePhoneRating($oldPhone,$Phone,$code){
            if($code==0){ $stmt = $this->conn->prepare("UPDATE Rating SET BookAccount=? WHERE BookAccount=?");
             $stmt->bind_param("ss",$Phone,$oldPhone);
             if($stmt->execute()){
             $stmt->close();
             return true;}else{
             $stmt->close();
             return false;
             }
            } else if($code==1){
                  $stmt = $this->conn->prepare("UPDATE Rating SET CabDriver=? WHERE CabDriver=?");
             $stmt->bind_param("ss",$Phone,$oldPhone);
             if($stmt->execute()){
            $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
            }
        }
      
      public function updateImagePhoneRating($phone,$image){
             $stmt = $this->conn->prepare("UPDATE Rating SET Image=? WHERE BookAccount=?");
             $stmt->bind_param("ss",$image,$phone);
             if($stmt->execute()){
             $stmt->close();
             return true;}else{
             $stmt->close();
             return false;
             }
            
        }
        
      public function updatePhoneTripBooking($oldPhone,$Phone,$code){
            if($code==0){
        $stmt = $this->conn->prepare("UPDATE TripBooking SET BookAccount=? WHERE BookAccount=?");
             $stmt->bind_param("ss",$Phone,$oldPhone);
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
         }
         else if($code==1){
             $stmt = $this->conn->prepare("UPDATE TripBooking SET CabDriver=? WHERE CabDriver=?");
             $stmt->bind_param("ss",$Phone,$oldPhone);
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
         }
        }
        
      public function updateDriver($id,$oldPhone,$Name,$Phone,$image,$Email){
          $stmt = $this->conn->prepare("UPDATE Driver SET Name=? ,Phone=?,driverImage=?,Email=?  WHERE Id=?");
             $stmt->bind_param("sssss",$Name,$Phone,$image,$Email,$id);
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
      }
      /* Update Avatar URL
      *return true or false
      */
      public function updateAadharUrl($phone,$filename){
         return $result = $this->conn->query("UPDATE Driver SET AadharImage = '$filename' WHERE Phone = '$phone'");

      }
      
      public function updateLicenseUrl($phone,$filename){
         return $result = $this->conn->query("UPDATE Driver SET LicenseImage = '$filename' WHERE Phone = '$phone'");

      }
      
      public function updateCabDetail($CabType,$CabImage,$CabCity,$Phone,$cabBrand,$cabModel,$cabSitting,$CabNumber){
          
          $stmt = $this->conn->prepare("UPDATE CabDetails SET `CabBrand`=?,`CabModel`=?,`CabNumber`=?,`CabImage`=?,`CabSitting`=?,`CabDriver`=?,`CabType`=?,`CabLocation`=?  WHERE `CabDriver`=?");
          
             $stmt->bind_param("sssssssss",$cabBrand,$cabModel,$CabNumber,$CabImage,$cabSitting,$Phone,$CabType,$CabCity,$Phone);
             
             if($stmt->execute()){
             $stmt->close();
             return true;
             }else{
             $stmt->close();
             return false;
             }
      }
      
      public function updateToken($phone,$token,$isServerToken){
           $stmt = $this->conn->prepare("UPDATE `Token` SET `token`=?,`isServerToken`=? WHERE phone=?");
            $stmt->bind_param("sss",$token,$isServerToken,$phone);
            if($stmt->execute())
            {
                 $stmt->close();
                 return true;
            }
            else
            {
                 $stmt->close();
                return false;
            }
       }
       
       public function updateCabDriverStatus($code,$driverPhone){
           if($code==1){
           $stmt = $this->conn->prepare("UPDATE `Driver` SET `DriverStatus`=1 WHERE Phone=?");
             $stmt->bind_param("s",$driverPhone);
            $result= $stmt->execute();
         $stmt->close();
            if($result){
                 $driver = $this->conn->query("SELECT * FROM Driver WHERE Phone='$driverPhone'");
                  $drive = $driver->fetch_assoc();
          	 return $drive;
                 
            }else{
                return false;
            }
        }else if($code==2){
            $stmt = $this->conn->prepare("UPDATE `Driver` SET `DriverStatus`=2 WHERE Phone=?");
             $stmt->bind_param("s",$driverPhone);
            $result= $stmt->execute();
         $stmt->close();
            if($result){
              $driver = $this->conn->query("SELECT * FROM Driver WHERE Phone='$driverPhone'");
                  $drive = $driver->fetch_assoc();
          	 return $drive;   
            }else{
                return false;
            }
        }
       }
       
       /*******************mailing function************************/
       public function sendMail($to,$req_name,$req_password){
           // Pear Mail Library
            require_once "Mail.php";
            
            $from = '<email-id>';
            $subject = 'URDrive Response';
            $content = "text/html";

            $message = '<html><body>';
            $message .= '<strong><h2>Hi '.strip_tags($req_name).',</h2></strong>';
            $message .= '<p>Congratulations! You&apos;re now part of a community your request is accepted. </p>
            <strong><p>Please login with given below.</p></strong>';
            $message .= '<img src="myinvented.com/urdriver/driver_license/download.png" height="42" width="42" />';
            $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
            $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($req_name) . "</td></tr>";
            $message .= "<tr><td><strong>Username:</strong> </td><td>" . strip_tags($to) . "</td></tr>";
            $message .= "<tr><td><strong>Password:</strong> </td><td>" . strip_tags($req_password) . "</td></tr>";
            $message .= "</table>";
            $message .= "</body></html>";

            $headers = array(
             'From' => $from,
             'To' => $to,
             'Subject' => $subject,
             'Content-Type'=> $content
            );

            $smtp = Mail::factory('smtp', array(
            'host' => 'mail-service',
            'port' => 'port',
            'auth' => true,
            'username' => 'email-id',
            'password' => 'password-of-email'
            ));

            $mail = $smtp->send($to, $headers, $message);

            if (PEAR::isError($mail)) {
                error_log($mail->getMessage());
                // return "'<p>' . $mail->getMessage() . '</p>'";
                return false;
            } else {
                return true;
            }
       }
       
       public function sendMailNot($to,$name,$arr){
           // Pear Mail Library
            require_once "Mail.php";
            
            $from = '<email-id>';
            $subject = 'URDrive Response';
            $content = "text/html";
            $script="";         
            $i=0;
            for($i=0;$i<sizeof($arr);$i++){
              $script .=  nl2br("&#8226;$arr[$i]\n\n");
            }
            
            $message = '<html>
                        <head>
                        <img src="myinvented.com/urdriver/driver_license/download.png" height="42" width="42" />
                        <strong><h1>Hi '.$name.',</h1></strong>
                        <p>Oops! Your request is denied. </p>
                        <strong><p><h3>Please give below information correctly.</h3></p>
                        </strong>
                        <h4>
                        '.$script.'
                        </h4>
                        </head>
                        <body>
                        </body>
                        </html>';
            $headers = array(
             'From' => $from,
             'To' => $to,
             'Subject' => $subject,
             'Content-Type'=> $content
            );

            $smtp = Mail::factory('smtp', array(
            'host' => 'mail-service',
            'port' => '25',
            'auth' => true,
            'username' => 'email-id',
            'password' => 'password'
            ));

            $mail = $smtp->send($to, $headers, $message);

            if (PEAR::isError($mail)) {
                error_log($mail->getMessage());
                // return "'<p>' . $mail->getMessage() . '</p>'";
                return false;
            } else {
                return true;
            }
       }
       
      /******************Delete***********************************/
      public function deleteDriver($phone){
          $stmt =  $this->conn->prepare("UPDATE `Driver` SET DriverStatus = 2 WHERE Phone = ?");
          $stmt->bind_param("s",$phone);
          
          if($stmt->execute()){
              $stmt->close(); 
              return true;
          }else
          {
              return false;
          }
      }
      
      /********************upload Image**************************/
      public function uploadDriverImage($path,$image){
        $resp = file_put_contents($path,base64_decode($image));
        return $resp;
      }
      
      /******************update server***************************/
      
      public function getTxnStatusTrip(){
         $result = $this->conn->query("SELECT CabTnxId,Id FROM TripBooking WHERE TripStatus = 5");
          $data = array();
        while($item = $result->fetch_assoc())
         {
            $data[] = $item;
         }
         return $data;
      }
      
      //mid,marchent id
      public function getPaymentStatus($orderId){
        require_once("./paytm/lib/encdec_paytm.php");
        $paytmParams = array();

        $paytmParams["body"] = array(

            "mid" => "lefWcy75852380738118",
            "orderId" => $orderId,
        );

        $checksum = getChecksumFromString(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), "mkESiXpeZNOxrW11");

        $paytmParams["head"] = array(
            "signature"	=> $checksum
        );

        $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

        $url = "https://securegw-stage.paytm.in/merchant-status/api/v1/getPaymentStatus";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));  
        $response = curl_exec($ch);
      }
      
      //mid,marchent id
      public function refundApply($orderId,$txnId,$RefundId,$RefundAmount){
        require_once("./paytm/lib/encdec_paytm.php");
        $paytmParams = array();

        $paytmParams["body"] = array(

        "mid" => "lefWcy75852380738118",

        "txnType" => "REFUND",

        "orderId" => $orderId,

        "txnId" => $txnId,

        "refId" => $RefundId,

    /* Enter amount that needs to be refunded, this must be numeric */
        "refundAmount" => $RefundAmount,
        );

        $checksum = getChecksumFromString(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), "mkESiXpeZNOxrW11");

    $paytmParams["head"] = array(

        "clientId"	=> "C11",
        "signature"	=> $checksum
    );

    $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

    $url = "https://securegw-stage.paytm.in/refund/apply";
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json")); 
    $response = curl_exec($ch);
    return $response;
}

      //mid,marchent id
      public function getRefundStatus($orderId,$RefundId){
        require_once("./paytm/lib/encdec_paytm.php");
        $paytmParams = array();

        $paytmParams["body"] = array(
	        "mid" => "lefWcy75852380738118",
	        "orderId" => $orderId,
	        "refId" => $RefundId,
        );

        $checksum = getChecksumFromString(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), "mkESiXpeZNOxrW11");
        $paytmParams["head"] = array(
	"clientId"	=> "C11",
	"signature"	=> $checksum
);
        $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

        $url = "https://securegw-stage.paytm.in/v2/refund/status";
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json")); 
        $response = curl_exec($ch);
        return $response;
      }
      
      public function updateTxnIdTrip($Id,$TnxId){
         $stmt = $this->conn->prepare("UPDATE TripBooking SET CabTnxId = ? WHERE Id = ?");
             $stmt->bind_param("ss",$TnxId,$Id);
             if($stmt->execute()){
             $stmt->close();
             return true;}else{
             $stmt->close();
             return false;
             }

      }
      
     public function generateRandomString($length,$alpha = false, $nums = true, 
        $usetime = true, $string = '') {
$alpha = ($alpha == true) ? 'abcdefghijklmnopqrstuvwxyz' : '';
$nums = ($nums == true) ? '1234567890' : '';

if ($alpha == true || $nums == true || !empty($string)) {
    if ($alpha == true) {
        $alpha = $alpha;
        $alpha .= strtoupper($alpha);
    } 
}
$randomstring = '';
$totallength = $length;
    for ($na = 0; $na < $totallength; $na++) {
            $var = (bool)rand(0,1);
            if ($var == 1 && $alpha == true) {
                $randomstring .= $alpha[(rand() % mb_strlen($alpha))];
            } else {
                $randomstring .= $nums[(rand() % mb_strlen($nums))];
            }
    }
if ($usetime == true) {
    $randomstring = $randomstring.time();
}
return($randomstring);
} 

     public function CancelCab($cabModel,$BookAccount){
             $stmt = $this->conn->prepare("SELECT * FROM OneWayBooking WHERE BookAccount=? AND CabModel=?");
            $stmt->bind_param("ss",$BookAccount,$cabModel);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows >= 1)
            {
             $stmt->close();
             $result = $this->conn->query("SELECT * FROM OneWayBooking WHERE BookAccount='$BookAccount' AND CabModel='$cabModel'");
             $t = array();
             while($item = $result->fetch_assoc())
             {
                $t[] = $item;
                $cc = $t[0];
                $c = json_decode($cc["CabTnxId"]);
                if($c->TxnStatus=="TXN_SUCCESS" and $c->TxnType=="Receiving")
                {
                    $ran = $this->generateRandomString(10,false,true,true,'');
                    $amount = $c->TnxAmount-(($c->TnxAmount/100)*10);
                     $ch = $this->refundApply($c->OrderId,$c->TxnId,$ran,$amount);
                    $c->RefundId = $ran;
                    $c->TnxAmount=$amount;
                    $p = json_decode($ch);
                    if($p->body->resultInfo->resultStatus=="TXN_FAILURE"){
                        $c->TxnStatus = "TXN_FAILURE";
                        $c->TxnType="Refund";
                        $this->insertNewTripBooking($cc["fullName"],$cc["phoneNumber"],$cc["email"],$cc["sourceAddress"],$cc["destinationAddress"],$cc["pickupDate"],"00-00-0000",$cc["pickupTime"],$cc["source"],$cc["destination"],$cc["Cabs"],$cc["BookAccount"],$cc["CabFare"],$cc["CabDriver"],$cc["CabStatus"],$cc["CabModel"],json_encode($c),"00-00-0000","00-00-0000",5,0,0,0,5);
                        $stmt = $this->conn->prepare("DELETE FROM OneWayBooking WHERE BookAccount=? AND CabModel=?");
                        $stmt->bind_param("ss",$BookAccount,$cabModel);
                        if($stmt->execute()){
                            $stmt->close();
                            return "ok";
                        }
                        else{
                            $stmt->close();
                            return false;
                        }
                    }
                    else if($p->body->resultInfo->resultStatus=="PENDING"){
                        $c->TxnStatus = "PENDING";
                        $c->TxnType="Refund";
                        $this->insertNewTripBooking($cc["fullName"],$cc["phoneNumber"],$cc["email"],$cc["sourceAddress"],$cc["destinationAddress"],$cc["pickupDate"],"00-00-0000",$cc["pickupTime"],$cc["source"],$cc["destination"],$cc["Cabs"],$cc["BookAccount"],$cc["CabFare"],$cc["CabDriver"],$cc["CabStatus"],$cc["CabModel"],json_encode($c),"00-00-0000","00-00-0000",5,0,0,0,5);
                        $stmt = $this->conn->prepare("DELETE FROM OneWayBooking WHERE BookAccount=? AND CabModel=?");
                        $stmt->bind_param("ss",$BookAccount,$cabModel);
                        if($stmt->execute()){
                            $stmt->close();
                            return "ok";
                        }
                        else{
                            $stmt->close();
                            return "false";
                        }
                    }
                }
                break;
            }
            }
            else{
                $stmt = $this->conn->prepare("SELECT * FROM RoundWayBooking WHERE BookAccount=? AND CabModel=?");
            $stmt->bind_param("ss",$BookAccount,$cabModel);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows >= 1)
            {
             $stmt->close();
             $result = $this->conn->query("SELECT * FROM RoundWayBooking WHERE BookAccount='$BookAccount' AND CabModel='$cabModel'");
             $t = array();
             while($item = $result->fetch_assoc())
             {
                $t[] = $item;
                $cc = $t[0];
                $c = json_decode($cc["CabTnxId"]);
                if($c->TxnStatus=="TXN_SUCCESS" and $c->TxnType=="Receiving")
                {
                    $ran = $this->generateRandomString(10,false,true,true,'');
                    $amount = $c->TnxAmount-(($c->TnxAmount/100)*10);
                     $ch = $this->refundApply($c->OrderId,$c->TxnId,$ran,$amount);
                    $c->RefundId = $ran;
                    $c->TnxAmount=$amount;
                    $p = json_decode($ch);
                    if($p->body->resultInfo->resultStatus=="TXN_FAILURE"){
                        $c->TxnStatus = "TXN_FAILURE";
                        $c->TxnType="Refund";
                        $this->insertNewTripBooking($cc["fullName"],$cc["phoneNumber"],$cc["email"],$cc["sourceAddress"],$cc["destinationAddress"],$cc["pickupDate"],$cc["dropDate"],$cc["pickupTime"],$cc["source"],$cc["destination"],$cc["Cabs"],$cc["BookAccount"],$cc["cabFare"],$cc["cabDriver"],$cc["cabStatus"],$cc["cabModel"],json_encode($c),00-00-0000,00-00-0000,5,0,0,0,5);
                        $stmt = $this->conn->prepare("DELETE FROM RoundWayBooking WHERE BookAccount=? AND CabModel=?");
                        $stmt->bind_param("ss",$BookAccount,$cabModel);
                        if($stmt->execute()){
                            $stmt->close();
                            return "ok";
                        }
                        else{
                            $stmt->close();
                            return "false";
                        }
                    }
                    else if($p->body->resultInfo->resultStatus=="PENDING"){
                        $c->TxnStatus = "PENDING";
                        $c->TxnType="Refund";
                        $this->insertNewTripBooking($cc["fullName"],$cc["phoneNumber"],$cc["email"],$cc["sourceAddress"],$cc["destinationAddress"],$cc["pickupDate"],$cc["dropDate"],$cc["pickupTime"],$cc["source"],$cc["destination"],$cc["Cabs"],$cc["BookAccount"],$cc["cabFare"],$cc["cabDriver"],$cc["cabStatus"],$cc["cabModel"],json_encode($c),00-00-0000,00-00-0000,5,0,0,0,5);
                        $stmt = $this->conn->prepare("DELETE FROM RoundWayBooking WHERE BookAccount=? AND CabModel=?");
                        $stmt->bind_param("ss",$BookAccount,$cabModel);
                        if($stmt->execute()){
                            $stmt->close();
                            return "ok";
                        }
                        else{
                            $stmt->close();
                            return "false";
                        }
                    }
                }
                break;
            }
            }
            else{
                return "No Cab is booked now";
            }
            }
         
     }
     
     public function getCancelledCabForUser($BookAccount){
         $result = $this->conn->query("SELECT * From TripBooking WHERE BookAccount = '$BookAccount' AND TripStatus IN(5,6) ORDER BY Id");
         $cabs = array();
         while($item = $result->fetch_assoc()){
         $cabs[] = $item;
      }
         return $cabs;
     }
     
     public function getCancelledCabForAdmin(){
         $result = $this->conn->query("SELECT * From TripBooking WHERE TripStatus IN(5,6) ORDER BY Id DESC");
         $cabs = array();
         while($item = $result->fetch_assoc()){
         $cabs[] = $item;
      }
         return $cabs;
     }
     
     public function getCancelledCabForDriver($CabDriver){
         $result = $this->conn->query("SELECT * From TripBooking WHERE CabDriver = '$CabDriver' AND TripStatus IN(5,6) ORDER BY Id");
         $cabs = array();
         while($item = $result->fetch_assoc()){
         $cabs[] = $item;
      }
         return $cabs;
     }
     
     public function cancelledCabByDriver($Id,$CabDriver,$code){
        if($code=="0"){
             $result = $this->conn->query("SELECT * FROM OneWayBooking WHERE CabDriver='$CabDriver' AND Id='$Id'");
             $t = array();
             while($item = $result->fetch_assoc())
             {
                $t[] = $item;
                $cc = $t[0];
                $c = json_decode($cc["CabTnxId"]);
                if($c->TxnStatus=="TXN_SUCCESS" and $c->TxnType=="Receiving")
                {
                    $ran = $this->generateRandomString(10,false,true,true,'');
                    $amount = $c->TnxAmount-(($c->TnxAmount/100)*10);
                     $ch = $this->refundApply($c->OrderId,$c->TxnId,$ran,$amount);
                    $c->RefundId = $ran;
                    $c->TnxAmount=$amount;
                    $p = json_decode($ch);
                    if($p->body->resultInfo->resultStatus=="TXN_FAILURE"){
                        $c->TxnStatus = "TXN_FAILURE";
                        $c->TxnType="Refund";
                        $this->insertNewTripBooking($cc["fullName"],$cc["phoneNumber"],$cc["email"],$cc["sourceAddress"],$cc["destinationAddress"],$cc["pickupDate"],"00-00-0000",$cc["pickupTime"],$cc["source"],$cc["destination"],$cc["Cabs"],$cc["BookAccount"],$cc["CabFare"],$cc["CabDriver"],$cc["CabStatus"],$cc["CabModel"],json_encode($c),"00-00-0000","00-00-0000",6,0,0,0,6);
                        $stmt = $this->conn->prepare("DELETE FROM OneWayBooking WHERE CabDriver=? AND Id=?");
                        $stmt->bind_param("ss",$CabDriver,$Id);
                        if($stmt->execute()){
                            $stmt->close();
                            return "ok";
                        }
                        else{
                            $stmt->close();
                            return "false";
                        }
                    }
                    else if($p->body->resultInfo->resultStatus=="PENDING"){
                        $c->TxnStatus = "PENDING";
                        $c->TxnType="Refund";
                        $this->insertNewTripBooking($cc["fullName"],$cc["phoneNumber"],$cc["email"],$cc["sourceAddress"],$cc["destinationAddress"],$cc["pickupDate"],"00-00-0000",$cc["pickupTime"],$cc["source"],$cc["destination"],$cc["Cabs"],$cc["BookAccount"],$cc["CabFare"],$cc["CabDriver"],$cc["CabStatus"],$cc["CabModel"],json_encode($c),"00-00-0000","00-00-0000",6,0,0,0,6);
                        $stmt = $this->conn->prepare("DELETE FROM OneWayBooking WHERE CabDriver=? AND Id=?");
                        $stmt->bind_param("ss",$CabDriver,$Id);
                        if($stmt->execute()){
                            $stmt->close();
                            return "ok";
                        }
                        else{
                            $stmt->close();
                            return "false";
                        }
                    }
                }
                break;
            }
        }
        else if($code==1){
             $result = $this->conn->query("SELECT * FROM RoundWayBooking WHERE CabDriver='$CabDriver' AND Id='$Id'");
             $t = array();
             while($item = $result->fetch_assoc())
             {
                $t[] = $item;
                $cc = $t[0];
                $c = json_decode($cc["CabTnxId"]);
                if($c->TxnStatus=="TXN_SUCCESS" and $c->TxnType=="Receiving")
                {
                    $ran = $this->generateRandomString(10,false,true,true,'');
                    $amount = $c->TnxAmount-(($c->TnxAmount/100)*10);
                     $ch = $this->refundApply($c->OrderId,$c->TxnId,$ran,$amount);
                    $c->RefundId = $ran;
                    $c->TnxAmount=$amount;
                    $p = json_decode($ch);
                    if($p->body->resultInfo->resultStatus=="TXN_FAILURE"){
                        $c->TxnStatus = "TXN_FAILURE";
                        $c->TxnType="Refund";
                        $this->insertNewTripBooking($cc["fullName"],$cc["phoneNumber"],$cc["email"],$cc["sourceAddress"],$cc["destinationAddress"],$cc["pickupDate"],$cc["dropDate"],$cc["pickupTime"],$cc["source"],$cc["destination"],$cc["Cabs"],$cc["BookAccount"],$cc["cabFare"],$cc["cabDriver"],$cc["cabStatus"],$cc["cabModel"],json_encode($c),00-00-0000,00-00-0000,6,0,0,0,6);
                        $stmt = $this->conn->prepare("DELETE FROM RoundWayBooking WHERE BookAccount=? AND CabModel=?");
                        $stmt->bind_param("ss",$BookAccount,$cabModel);
                        if($stmt->execute()){
                            $stmt->close();
                            return "ok";
                        }
                        else{
                            $stmt->close();
                            return "false";
                        }
                    }
                    else if($p->body->resultInfo->resultStatus=="PENDING"){
                        $c->TxnStatus = "PENDING";
                        $c->TxnType="Refund";
                        $this->insertNewTripBooking($cc["fullName"],$cc["phoneNumber"],$cc["email"],$cc["sourceAddress"],$cc["destinationAddress"],$cc["pickupDate"],$cc["dropDate"],$cc["pickupTime"],$cc["source"],$cc["destination"],$cc["Cabs"],$cc["BookAccount"],$cc["cabFare"],$cc["cabDriver"],$cc["cabStatus"],$cc["cabModel"],json_encode($c),00-00-0000,00-00-0000,6,0,0,0,6);
                        $stmt = $this->conn->prepare("DELETE FROM RoundWayBooking WHERE BookAccount=? AND CabModel=?");
                        $stmt->bind_param("ss",$BookAccount,$cabModel);
                        if($stmt->execute()){
                            $stmt->close();
                            return "ok";
                        }
                        else{
                            $stmt->close();
                            return "false";
                        }
                    }
                }
                break;
            }
            }
     }
     
     public function getTripDetailForUser($BookAccount,$CabDriver){
         $stmt = $this->conn->prepare("SELECT * FROM TripBooking WHERE BookAccount=? AND CabDriver=? AND TripStatus='3'");
         $stmt->bind_param("ss",$BookAccount,$CabDriver);
         $stmt->execute();
         $result = $stmt->get_result()->fetch_assoc();
         $stmt->close();
         return $result;
     }
     
}
?>