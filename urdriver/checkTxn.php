<?php
require_once 'db_functions.php';
$db = new DB_Functions();

$data = $db->getTxnStatusTrip();
$driver = array();
 foreach($data as $item)
 {
     $c = json_decode($item["CabTnxId"]);
     
     if($c->TxnStatus=="PENDING" and $c->TxnType=="Refund"){
        $ch = $db->getRefundStatus($c->OrderId,$c->RefundId);
        $p = json_decode($ch);
        if($p->body->resultInfo->resultStatus=="TXN_FAILURE"){
            $c->TxnStatus = "TXN_FAILURE";
            $c->TxnType="Refund";
            $db->updateTxnIdOneWay($item["Id"],json_encode($c));
        }
        else if($p->body->resultInfo->resultStatus=="PENDING"){
             $c->TxnStatus = "PENDING";
            $c->TxnType="Refund";
            $db->updateTxnIdTrip($item["Id"],json_encode($c));
        }
     }
     
     /*$ran = $db->generateRandomString(10,false,true,true,'');
        $amount = $c->TnxAmount-(($c->TnxAmount/100)*10);
        $ch = $db->refundApply($c->OrderId,$c->TxnId,$ran,$amount);
        $c->RefundId = $ran;
        $c->TnxAmount=$amount;
        $p = json_decode($ch);
        
        if($p->body->resultInfo->resultStatus=="TXN_FAILURE"){
            $c->TxnStatus = "TXN_FAILURE";
            $c->TxnType="Refund";
            $db->updateTxnIdOneWay($item["Id"],json_encode($c));
        }
        else if($p->body->resultInfo->resultStatus=="PENDING"){
             $c->TxnStatus = "PENDING";
            $c->TxnType="Refund";
            $db->updateTxnIdTrip($item["Id"],json_encode($c));
        }*/
 }
?>