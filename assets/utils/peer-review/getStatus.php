<?php
include '../db_link.php';
include 'exit.php';

function getDetails($id){
    $link2 = linkToSMP();
    $handle2 = null;
    $sql2="SELECT * FROM `reviews` WHERE `id`=:id";
//    $sql2="SELECT * FROM `details` WHERE `id`=:id";
    $handle2=$link2->prepare($sql2);
    $handle2->execute(array('id'=>$id));
    $result2=$handle2->fetchAll(PDO::FETCH_ASSOC);
    return $result2[0];
}

function getStatus(){
    try{
        session_start();
        if(isset($_SESSION['code'])){
            $code=$_SESSION['code'];
            $link = linkToSMP();
            $handle = null;
            $sql="SELECT * FROM `reviews` WHERE `code`=:code AND `active`=1 LIMIT 1";
            $handle=$link->prepare($sql);
            $handle->execute(array('code'=>$code));
            if($handle->rowCount()==0) {
                destroy();
                return 'F';
            }
            else{
                $json['name'] = $_SESSION['name'];
                // Send peer details only when it is compulsory peer
                if($_SESSION['last_done'] !== 1) {
                    $peer_details = getDetails($_SESSION['peer_ids'][$_SESSION['current']]);
                    $json['peer_name'] = $peer_details['name'];
                    $json['peer_dept'] = $peer_details['dept'];
                    $json['peer_hostel'] = $peer_details['hostel'];
                }
                
                $json['total_peers'] = count($_SESSION['peer_ids']);
                $json['given'] = count($_SESSION['data']);
                $json['total_other_peers'] = $_SESSION['total_other_peers'];
                $json['others_given'] = count($_SESSION['other_data']);
                /*$json['data'] = $_SESSION['data'];
                $json['other_data'] = $_SESSION['other_data'];
                $json['other_peer_ids'] = $_SESSION['other_peer_ids'];*/
                
                // Check for last compulsory peer
                if($_SESSION['current'] == count($_SESSION['peer_ids'])) $_SESSION['last_done'] = 1;
                $json['last_done'] = $_SESSION['last_done'];
            }
        }
        else{
            destroy();
            return 'F';
        }
        return json_encode($json);
    }
    catch(Exception $e)
    {
        var_dump($e);
        return "F";
    }
}
echo getStatus();