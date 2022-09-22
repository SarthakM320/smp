<?php
include 'exit.php';
include '../db_link.php';
function getName($id){
    $link2 = linkToSMP();
    $handle2 = null;
    $sql2="SELECT * FROM `reviews` WHERE `id`=:id";
    $handle2=$link2->prepare($sql2);
    $handle2->execute(array('id'=>$id));
    $result2=$handle2->fetchAll(PDO::FETCH_ASSOC);
    return $result2[0]['name'];
}
function update(){
    try{
        session_start();
        if(isset($_SESSION['code']) && isset($_POST['data'])){
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
                $_SESSION['current']=$_SESSION['current']+1;
                if($_SESSION['last_done'] === 0){
                    array_push($_SESSION['data'],$_POST['data']);
                } 
                else{
                    array_push($_SESSION['other_data'],$_POST['data']);
                    array_push($_SESSION['other_peer_ids'],$_POST['id']);
                }
                return "S";
            }
        }
        else{
            destroy();
            return 'F';
        }
    }
    catch(Exception $e)
    {
        var_dump($e);
        return "F";
    }
}
echo update();