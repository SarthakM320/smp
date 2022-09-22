<?php
include '../db_link.php';
include 'exit.php';

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
                $given_peer_ids = array_merge($_SESSION['peer_ids'],$_SESSION['other_peer_ids']);
                array_push($given_peer_ids, $_SESSION['user_id']);
                $in = implode(',', array_fill(0, count($given_peer_ids), '?'));
                $sql1 = "SELECT id, name FROM `reviews` WHERE id NOT IN ($in)";
                $handle1 = $link->prepare($sql1);
                $handle1->execute($given_peer_ids); 
                $result1 = $handle1->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        else{
            destroy();
            return 'F';
        }
        return json_encode($result1);
    }
    catch(Exception $e)
    {
        var_dump($e);
        return 'F';
    }
}
echo getStatus();