<?php
include 'exit.php';
include '../db_link.php';

function finish(){
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
                $final_data = array();
                $length = count($_SESSION['peer_ids']);
                for($i = 0; $i < $length; $i++) {
                    $response = $_SESSION['data'][$i];
                    if(count($response) > 0) {
                        array_unshift($response, $_SESSION['peer_ids'][$i]);
                        array_push($final_data, $response);
                    }
                }

                $length = count($_SESSION['other_peer_ids']);
                for($i = 0; $i < $length; $i++) {
                    $response = $_SESSION['other_data'][$i];
                    array_unshift($response, $_SESSION['other_peer_ids'][$i]);
                    array_push($final_data, $response);
                }

                $json=json_encode($final_data);
                $id = $_SESSION['user_id'];
                $sql="UPDATE `reviews` SET `active`='0',`login`='0',`data`=:data WHERE `id`=:id";
                $handle=$link->prepare($sql);
                $handle->execute(array('data'=>$json, 'id' => $id));
                destroy();
                return "S";
            }
        }
        else{
            destroy();
            return json_encode($_POST['data']);
        }
    }
    catch(Exception $e)
    {
        var_dump($e);
        return "F";
    }
}
echo finish();